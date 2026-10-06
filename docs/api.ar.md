# الواجهات ومسارات التنفيذ

اختيار زوج مدعوم ← عرض تقدير ثابت ← إدخال بيانات مستلم اصطناعية ← إثبات اختياري ← فحص PHP ← قبول العرض أو تأكيد المزود ← رقم عملية من الخادم.

تحتاج المسارات المحلية للموجه إلى بادئة الخادم. تستخدم مسارات PHP الملفات الفعلية ما لم توجد إعادة كتابة. المتحكمات والوسطاء في الشيفرة مرجع الحقول والصلاحيات. فحوص tools/check-demo تمثل طلبات حقيقية ببيانات اصطناعية وليست مزوداً وهمياً.

## مراجع التنفيذ

- [Exchange.html](../Exchange.html)
- [post.php](../post.php)
- [currency-options.json](../currency-options.json)

## حدود التكامل

يعرف الإيصال استقبال الطلب ولا يثبت التنفيذ المالي. التتبع العام عرض تاريخي دون سجل عمليات حي. يلزم فحص صورة إثبات صحيحة وفشل المزود قبل استقبال طلبات حقيقية.


## جرد المسارات



## مثال الاستخدام

تستخدم POST حقول amount وfromCurrencyText وtoCurrencyText وwalletAddress وcardCode وصورة uploadedImage اختيارية. يجب مطابقة أسماء currency-options.json. يُفحص المحتوى الفعلي فلا يجيز تغيير MIME ملفاً عشوائياً. رقم العملية إيصال استقبال فقط.

```sh
python tools/check-demo.py
# Open http://localhost:8085/Exchange.html for the maintained request form.
# POST /post.php accepts multipart/form-data for genuine proof images.
# 200 status=success is demo acceptance/provider confirmation; 422 rejects input.
```
