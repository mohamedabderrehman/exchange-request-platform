"""Synthetic HTTP acceptance checks; start PHP in DEMO_MODE=1 first."""
import json,urllib.request,urllib.error,uuid,os
from pathlib import Path
root=Path(__file__).resolve().parents[1]
results=[]
def call(url,data,headers=None):
 if isinstance(data,dict): data=json.dumps(data,ensure_ascii=False).encode()
 request=urllib.request.Request(url,data=data,headers=headers or {'Content-Type':'application/json'})
 try:
  with urllib.request.urlopen(request,timeout=10) as response:return response.status,json.load(response)
 except urllib.error.HTTPError as error:return error.code,json.load(error)
from urllib.parse import urlencode
opts=json.loads((root/'currency-options.json').read_text(encoding='utf-8'))
form={'amount':'15000','fromCurrencyText':next(iter(opts['from'])),'toCurrencyText':next(iter(opts['to'])),'walletAddress':'synthetic-recipient','cardCode':'synthetic-only'}
url=os.getenv('DEMO_API_URL','http://127.0.0.1:8085')+'/post.php';h={'Content-Type':'application/x-www-form-urlencoded'}
code,body=call(url,urlencode(form).encode(),h);assert code==200 and body['status']=='success' and body['demo'];results.append('Exchange synthetic request without proof: passed')
for field,value in [('amount','-1'),('amount','NaN'),('amount','0'),('fromCurrencyText','unsupported')]:
 code,_=call(url,urlencode(dict(form,**{field:value})).encode(),h);assert code==422
results.append('Exchange invalid amounts and unsupported currencies: passed')
boundary='portfolio-'+uuid.uuid4().hex
data=b''
for name,value in form.items():data+=f'--{boundary}\r\nContent-Disposition: form-data; name="{name}"\r\n\r\n{value}\r\n'.encode()
data+=f'--{boundary}\r\nContent-Disposition: form-data; name="uploadedImage"; filename="proof.jpg"\r\nContent-Type: image/jpeg\r\n\r\n'.encode()+b'not an image\r\n'+f'--{boundary}--\r\n'.encode()
code,_=call(url,data,{'Content-Type':'multipart/form-data; boundary='+boundary});assert code==422;results.append('Exchange forged image MIME/content rejected: passed')

print('\n'.join(results))
