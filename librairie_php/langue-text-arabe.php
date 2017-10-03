<?php
/***************************************************************************
 *                              T.R.I.A.D.E
 *                            ---------------
 *
 *   begin                : جانفي 2000
 *   copyright            : (C) 2000 E. TAESCH - T. TRACHET 
 *   Site                 : http://www.triade-educ.com
 *
 *
 ***************************************************************************/
/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either نسخة 2 of the License, or
 *   (at your option) any later نسخة.
 *
 ***************************************************************************/

if (!defined(INTITULEDIRECTION)) { define("INTITULEDIRECTION","direction"); }
if (!defined(INTITULEELEVE)) { define("INTITULEELEVE","�l�ve"); }
if (!defined(INTITULEELEVES)) { define("INTITULEELEVES","�l�ves"); }


// fichier pour langue cote admin.
// POUR TOUS -------------------
// brmozilla($_SESSION[navigateur]);
define("CLICKICI","اظغط هنا");
define("VALIDER","ابعث");
define("LANGTP22"," حذار - طلب فرض على الطاولة - عنوان");
define("LANGTP3"," رزنامة DST ");
define("LANGCHOIX","اختيار ...");
define("LANGCHOIX2","لا يوجد اي قسم");
define("LANGCHOIX3","--- اختيار ---");
define("LANGOUI","نعم");
define("LANGNON","لا");
define("LANGFERMERFEN","غلق النافذة");
define("LANGATT","حذار !");
define("LANGDONENR","المعطايات مسجلة");
define("LANGPATIENT","شكرا للإتظار");
define("LANGSTAGE1",'التصرف في التربصات المحترفة');
define("LANGINCONNU",'مجهول'); // doit être identique que langinconnu cote javascript
define("LANGABS",'غياب');
define("LANGRTD",'تأخير');
define("LANGRIEN",'لا شيء');
define("LANGENR",'سجل');
define("LANGRAS1",'اليوم, في ');
define("LANGDATEFORMAT",'jj/mm/aaaa');

//------------------------------
// titre
//-------------------------------

define("LANGTITRE3","رسالة متحرك في أعلى الصفحة");
define("LANGTITRE4","رسالة التمرير في الراية");
define("LANGTITRE5","استقبال رسالة");
define("LANGTITRE6","بعث عضو جديدالإدارة");
define("LANGTITRE7","بعث عضو جديدالحياة المدرسية");
define("LANGTITRE8","بعث  جديدأستاذ");
define("LANGTITRE9","بعث عضو جديدمتوسل");
define("LANGTITRE10","بعث تلميذ جديد");
define("LANGTITRE11","بعث مجموعة جديدة"); //
define("LANGTITRE12","بعث قسم جديد"); //
define("LANGTITRE13","بعث مادة جديدة"); //
define("LANGTITRE14","بعث مادة فرعية جديدة"); //
define("LANGTITRE16","بعث تعين جديد");
define("LANGTITRE17","بعث تعين جديد لقسم");
define("LANGTITRE18","مشاهد التعيين");
define("LANGTITRE19","تغيير تعيين");
define("LANGTITRE20","تغيير تعيين  القسم");
define("LANGTITRE21","فسخ تعيين");
define("LANGTITRE22","استيراد ملف ASCII (txt,csv) ");
define("LANGTITRE23","قائمة تأخير بدون مبرر ");
define("LANGTITRE24","إضافة اعفاء");
define("LANGTITRE25","قائمة / تغيير الإعفاءات");
define("LANGTITRE26","إحذف اعفاء");
define("LANGTITRE27","إدارة الإعفاءات -  جدولة");
define("LANGTITRE28","كشف / تغيير الإعفاءات");
define("LANGTITRE29","معاينة الأقسام");
define("LANGTITRE30","البحث عن تلميذ");
define("LANGTITRE31","استيراد ملف GEP");
define("LANGTITRE32","الصور التلاميذ");
define("LANGTITRE33","شهادة مدرسية");

define("LANGTE1","العنوان");
define("LANGTE2","من");
define("LANGTE3","من");
define("LANGTE4","عدد الحروف");
define("LANGTE5","الموضوع");
define("LANGTE6","  إلـى");
define("LANGTE6bis","إلى أولياء ");
define("LANGTE7","التاريخ");
define("LANGTE8","حذف الرسائل");
define("LANGTE9","قرأ");
define("LANGTE10","إلي :");
define("LANGTE11","إلى ");
define("LANGTE12","في ");
define("LANGTE13","إلى");
define("LANGTE14","إلى المجموعة ");

//------------------------------
define("LANGFETE","عيد سعيد لـ ");
define("LANGFEN1","أحداث اليم");
define("LANGFEN2","فروض اليوم");
//------------------------------
define("LANGLUNDI","الإثنين");
define("LANGMARDI","الثلاثاء");
define("LANGMERCREDI","الإربعاء");
define("LANGJEUDI","الخميس");
define("LANGVENDREDI","الجمعة");
define("LANGSAMEDI","السبت");
define("LANGDIMANCHE","الأحد");
// ------------------------------
define("LANGMESS1","بعـث رسالـة إلكترونيـة -  يــوم  :");
define("LANGMESS3","إبعـث رسـالة إلـىالحياة المدرسية : ");
define("LANGMESS4","إبعث رسـالة إلى أستاذ : ");
define("LANGMESS6","رسالة أرسل");
define("LANGMESS7","أخبار المسجلة");
define("LANGMESS8","رسالة أرسل");
define("LANGMESS9","الرد على رسالة - في ");
define("LANGMESS10",'يرجى ابلاغ الادارة.');
define("LANGMESS11",'من فضلك اعلم الإدارة.');
define("LANGMESS12",'للتحقق من صحة تواريخ الثلاثيات.');
define("LANGMESS13",'من فضلك انقر <a href="تحديد_الثلاثي.php">هنا</a>');
define("LANGMESS14",'تعيينات  هذا القسم لم يتم تسجيلها.');
define("LANGMESS15",'من فضلك انقر <a href="تكوين التعيينات_key.php">ici</a>');
define("LANGMESS16",'للمصادقة على تعيينات هذا القسم ');
define("LANGMESS17","تكوين");
define("LANGMESS18","S");     // première lettre من la phrase التاليe !!!
define("LANGMESS18bis"," مزيد من رسائل البريد الإلكتروني لاعلان,<br> افصل رسائل البريد الإلكتروني بفاصل  .");
define("LANGMESS19","نشط");
define("LANGMESS20","التكوين التحديث");
define("LANGMESS21","الإعلام بإستقبال رسالة في بريدك الخاص ");
define("LANGMESS22","إبعث رسـالة إلى مجموعة : ");
define("LANGMESS23","بعث مجموعة للتراسل ");
define("LANGMESS24"," بين إلى أعضاء المجموعة ");
define("LANGMESS25","اختر مختلف الأعضاء ضاغطا على الزر"); //
define("LANGMESS26","ابعث انشاء");
define("LANGMESS27","تكوين مجموعة رسائل");
define("LANGMESS28","قائمة  مجموعاتك للرسائل ");
define("LANGMESS29","مجموعة ");
define("LANGMESS30","قائمة الأشخاص ");
define("LANGMESS31","رسالة من ");
define("LANGMESS32","لديك حاليا ");
define("LANGMESS33","رسائل في الإتظار ");


// -----------------------------
// bouton
// PAS DE -->' (cote) !!!!
define("LANGBTS","التالي >");
define("LANGBT1","  الرسائل تسجيل شريط ");
define("LANGBT2","سجل معلومات");
define("LANGBT3","الخروج من دون إرسال");
define("LANGBT4","ابعث رسالة");
define("LANGBT5","انتظر, من فضلك");
define("LANGBT6","فسخ الرسائل المختارة");
define("LANGBT7","سجل العضو");
define("LANGBT11","قائمة  المناوبين");
define("LANGBT12","قائمة المجموعات");
define("LANGBT13","ابعث القسم أو الأقسام");
define("LANGBT14","سجل انشاء");
define("LANGBT15","قائمة الأقسام");
define("LANGBT16","قائمة المواد");
define("LANGBT17","سجل المواد الفرعية");
define("LANGBT18","تسجيل النظام الأساسي"); //
define("LANGBT19","ابعث"); //
define("LANGBT20","خروج بدون تسجيل"); //
define("LANGBT21","سجل التعيين"); //
define("LANGBT22","إحذف تعيين"); //
define("LANGBT23","ابعث الملف"); //
define("LANGBT24","كرر من جديد"); //
define("LANGBT25","تحديث صفحة"); //
define("LANGBT26","انشاء قسم جديد"); //
define("LANGBT27","جدولة الغياب والتأخير"); //
define("LANGBT28","معاينة"); //
define("LANGBT29","إحذف  غياب أو تأخير"); //
define("LANGBT30","ابعث التحديث"); //
define("LANGBT31","ابعث");
define("LANGBT32","إحذف اعفاءات");
define("LANGBT33","تغيير اعفاءات");
define("LANGBT34","اضف اعفاءات");
define("LANGBT35","تسجيل بيانات ");
define("LANGBT36","إعفاء  تغيير --  فريق ترياد");
define("LANGBT37","إرسال معلومات");
define("LANGBT38","ابعث");
define("LANGBT39","إبدأ البحث");
define("LANGBT40","حصول");
define("LANGBT41","انتهاء");
define("LANGBT42","ابعث التلاميذ لا مسجلةs");
define("LANGBT43","اطبـع  البطاقـة");
define("LANGBT44","التاريخ");
define("LANGBT45","تصفح الوثائق");
define("LANGBT46","سجل الصورة");
define("LANGBT47","أخرى تغيير");
define("LANGBT48","الخروج من هذه الوحدة");
define("LANGBT49","كشف كامل القسم");
define("LANGBT50","إحذف");
define("LANGBT51","ابعث بطلب D.S.T");
// -----------------------------
define("LANGCA1","ر"); //
define("LANGCA1bis","سالة لم تقرأ بعد"); // sans la première lettre
define("LANGCA2","ر"); //
define("LANGCA2bis","سالة قرأت"); // sans la الأولe lettre
define("LANGCA3","أ"); //
define("LANGCA3bis","شر في JJ/MM/AAAA  <BR> في حالة التاريخ غير <BR>متفق عليها ، و حدد المرجعية <br>"); // sans la الأولe lettre
// -----------------------------
define("LANGNA1","اللقب"); //
define("LANGNA2","الإسم"); //
define("LANGNA3","كلمة س"); //
define("LANGNA4","احداث عضو جديد \\n\\n فريق ترياد "); //
define("LANGNA5","تغيير&nbsp;من&nbsp;"); //
// -----------------------------
define("LANGELE1","ارشادات عن التلميذ"); //
define("LANGELE2","اللقب"); //
define("LANGELE3","الإسم"); //
define("LANGELE4","القسم"); //
define("LANGELE5","اختيار"); //
define("LANGELE6","نظام"); //
define("LANGELE7","مقيم"); //
define("LANGELE8","نصف مقيم"); //
define("LANGELE9","خارجي"); //
define("LANGELE10","تاريخ الولادة"); //
define("LANGELE11","الجنسية"); //
define("LANGELE12","رقم التلميذ"); //
// define("LANGELE12","رقم national"); //
define("LANGELE13","ارشادات عن العائلة"); //
define("LANGELE14","العنوان1"); //
define("LANGELE15","رقم البريد"); //
define("LANGELE16","البلدة"); //
define("LANGELE17","العنوان 2"); //
define("LANGELE18",""); //
define("LANGELE19",""); //
define("LANGELE20","رقم الهاتف"); //
define("LANGELE21","مهنة الأب"); //
define("LANGELE22","الهاتف الأب"); //
define("LANGELE23","مهنة الأم"); //
define("LANGELE24","الهاتف الأم"); //
define("LANGELE25","المعهد الساق"); //
define("LANGELE26","اسم المعهد"); //
define("LANGELE27","رقم المهد"); //
define("LANGELE28","احداث تلميذ جديد -- فريق ترياد"); //
define("LANGELE29","تلميذ موجد سابقا  -- فريق ترياد"); //
//------------------------------------------------------------
define("LANGGRP1","تسمية المجموعة"); //
define("LANGGRP2","اختار لأقسام لإحداث المجموعة"); //
define("LANGGRP3","إختار مختلف الأقسام ضاغطا على"); //
define("LANGGRP4","Ctrl"); //
define("LANGGRP5","و اضغط على الزر الأيسر للفأرة"); //
define("LANGGRP6","تسمية الفصيلة"); //
define("LANGGRP7","احداث قسم جديد -- فريق ترياد"); //
define("LANGGRP8","احداث مادة جديدة -- فريق ترياد"); //
define("LANGGRP9","تسمية المادة"); //
define("LANGGRP10","اسم المادة الفرعية"); //
//------------------------------------------------------------
//------------------------------------------------------------
define("LANGAFF1","تعيين  الأقسام"); //
define("LANGAFF2","!!  انجاز تعيين <u>حذف</u> كل أعداد القسم </u>"); //
define("LANGAFF3","تعيين  الأقسام"); //
//------------------------------------------------------------
define("LANGPER1","الطباعة فترة"); //
define("LANGPER2","بداية  فترة"); //
define("LANGPER3","نهاية  فترة"); //
define("LANGPER4","شعبة"); //
define("LANGPER5","تحصيل ملف PDF"); //
define("LANGPER6","مدرس "); //
define("LANGPER8","في قسم  "); //
define("LANGPER9","وحدة تعيين الأقسام"); //
define("LANGPER10","تحذير من هذه الوحدة هو استخدام البحث في مهمته الجديدة ، <br>انه يدمر كل المذكرات التلاميذ في الفصول المخصصة."); //
define("LANGPER11","حذار ، سيتم حذف أعداد الأقسام المختارة. \\n هل تستمر؟ \\n\\n فريق ترياد"); //
define("LANGPER12","بين في رمز الدخول.");
define("LANGPER13","التحقق من الرمز");
define("LANGPER14","عدد  المواد");
define("LANGPER15","انجاز تعيين  الأقسام");
define("LANGPER16","عدد");
define("LANGPER17","المادة");
define("LANGPER18","مدرس");
define("LANGPER19","ضارب");
define("LANGPER20","مجموعة");
define("LANGPER21","اللغـــة");
define("LANGPER22","اطبع هذه صفحة");
define("LANGPER23","تعيين");
define("LANGPER23bis","ناجح");  // تعيين xxxx ناجح
define("LANGPER24","توقف"); // تعيين xxxx توقف
define("LANGPER25"," قسم");
define("LANGPER26","مشاهدة");
define("LANGPER27","شاهد");
define("LANGPER28","مشاهد التعيين  الأقسام");
define("LANGPER29","!! تغيير تعيين <u>حذف</u> كل les الأعداد من القسم !!");
define("LANGPER30","تغيير");
define("LANGPER31","تغيير l'تعيين");
define("LANGPER32","تغيير تعيين");
define("LANGPER32bis","توقف"); // تغيير تعيين xxxx توقف
define("LANGPER33","فسخ التعيين  ل ");
define("LANGPER34","!!  فسخ تعيين <u>حذف</u> كل  الأعداد  القسم !!</u>");
define("LANGPER35","تعيين من القسم");
define("LANGPER35bis","حذف"); // تعيين من القسم  xxxx حذف
//------------------------------------------------------------------------------
define("LANGIMP1","استيراد قاعدة بيانات موجودة ");
define("LANGIMP2","بين  نوع ملف للاستيراد ");
define("LANGIMP3","مذكرةASCII ");
define("LANGIMP4","مذكرةGEP ");
define("LANGIMP5","وحدة استيراد ملف ASCII.");
define("LANGIMP6","ملف للإرسال <FONT color=RED><B>يجب</B></FONT> يحتوي <FONT COLOR=red><B>45</B></FONT> الميادين <I>(فارغ أو غير فارغ)</I> مفصولة بنفس الفاصل \"<FONT color=red><B>;</B></font>\" <I>اما وجود 44  مرة في حرف \"<FONT color=red><B>;</B></font>\"</I>");
define("LANGIMP7","هذا ترتيب الميادين المشيرة : ");
define("LANGIMP8","اللقب");
define("LANGIMP9","إسم");
define("LANGIMP10","قسم");
define("LANGIMP11","نضام");
define("LANGIMP12","تاريخ الولادة");
define("LANGIMP13","الجنسية");
define("LANGIMP14","إسم الولي");
define("LANGIMP15","إسم الولي");

define("LANGIMP16","العنوان&nbsp;1");
define("LANGIMP18","الرمز البريدي&nbsp;1");
define("LANGIMP19","بلدة&nbsp;1");

define("LANGIMP17","العنوان2");
define("LANGIMP18_2","الرمز البريدي&nbsp;2");
define("LANGIMP19_2","بلدة&nbsp;2");


define("LANGIMP20","الهاتف");
define("LANGIMP21","مهنة الأب");
define("LANGIMP22","الهاتف مهنة الأب");
define("LANGIMP23","مهنة الأم");
define("LANGIMP24","الهاتف مهنة الأم");
define("LANGIMP25","رقم المعهد");

define("LANGIMP26","lv1");
define("LANGIMP27","lv2");
define("LANGIMP28","الخيار");
define("LANGIMP29","رقم التلميذ");
define("LANGIMP30","تحذير ، سيتم تدمير قاعدة البيانات تكون تلقائية. \\n هل تريد الإستمرار ؟ \\n\\n L\' فريق ترياد");
define("LANGIMP31","تحذير : هذه الوحدة يستعمل عند الإستخدام لأول مرة ،<br> أنه يدمر كل المعلومات التلاميذ من  (أعداد والرسائل الإخبارية ، والحياة المدرسية).<br /> * ميدان اجباري");
define("LANGIMP39","بين إلى ملف الإرسال ");
define("LANGIMP40","مذكرةاحيلت -- فريق ترياد ");
define("LANGIMP41"," عدد  المجالات لم يحترم ");
define("LANGIMP42","بين لكل مرجع القسم المناظر ");
define("LANGIMP43","مذكرةلا مسجلة ");
// ------------------------------------------------------------------------------
define("LANGABS1","إدارة الغيابات - التأخيرات اليومية");
define("LANGABS2","جدولة غياب أو  تأخير");
define("LANGABS3","بين  إسم التلميذ");
define("LANGABS4","قائمة  الغيابات أو التأخيرات الغير مبررة");
define("LANGABS5","قائمة  الغيابات الغير مبررة");
define("LANGABS6","قائمة  التأخيرات الغير مبررة");
define("LANGABS7"," شاهد  تغيير  غياب أو تأخير");
define("LANGABS8","بين  إسم التلميذ");
define("LANGABS9","اعرض مع/أو إحذف  غياب أو تأخير");
define("LANGABS10","لا يوجد أي تلميذ في قاعدة البيانات");
define("LANGABS11","غياب/تأخير");
define("LANGABS12","السبب");
define("LANGABS13"," تأخر في");
define("LANGABS14","تأخير");
define("LANGABS15","غياب");
define("LANGABS16","إلغاء");
define("LANGABS17","تغيير غياب أو تأخير");
define("LANGABS18","غائب&nbsp;du&nbsp;");
define("LANGABS19","إلى&nbsp;");
define("LANGABS20","غياب/تأخير");
define("LANGABS21","المدة");
define("LANGABS22","السبب");
define("LANGABS23","ساعة / تاريخ");
define("LANGABS24","وضع الغياب أو التأخير في قسم ");
define("LANGABS25","إدارة غياب - تأخير");
define("LANGABS26","إدارة غياب - تأخير  جدولة");
define("LANGABS27","تسجيل بيانات ");
define("LANGABS28","البيانات المسجلة ");
define("LANGABS29","إ"); //الأولe lettre
define("LANGABS29bis","عفاء  :"); //suite
define("LANGABS30","إعفاء");
define("LANGABS31","قسم  ");
define("LANGABS32","ت"); //الأولe lettre
define("LANGABS32bis","أخير "); //suite
define("LANGABS33","في");
define("LANGABS34","من");
define("LANGABS35","غياب - تأخير - اعفاء   ");
define("LANGABS36","تحديث");
define("LANGABS37","اطبع  الغيابات, اعفاءات, التأخيرات, اليومية ");
define("LANGABS38"," هاتف.");
define("LANGABS39"," هاتف.  مهنة الأب ");
define("LANGABS40"," هاتف.  مهنة الأم");
define("LANGABS41","هاتف. المنزل   ");
define("LANGABS42","غائب  من ");
define("LANGABS43","أثناء ");
define("LANGABS44","أيام ");
define("LANGABS45","سجل التحديث ");
define("LANGABS46","من  ");

define("LANGDISP8","فسخ اعفاء");
//----------------------------------------------------------------------------
define("LANGPROJ1","اختيار  القسم");
define("LANGPROJ2","اختيار الثلاثي");
define("LANGPROJ3","الثلاثي 1");
define("LANGPROJ4","الثلاثي 2");
define("LANGPROJ5","الثلاثي 3");
define("LANGPROJ6","<font class=T2>  لا يوجد أي تلميذ في هذا القسم</font>");
define("LANGPROJ7","عدد  التأخيرات");
define("LANGPROJ8"," تراكم");
define("LANGPROJ9","الانضباط");
define("LANGPROJ10","دقائق");
define("LANGPROJ11","عدد المحتجزين");
define("LANGPROJ12","يكلفه بها ");
define("LANGPROJ13","قائمة");
define("LANGPROJ14","معدل تلميذ");
define("LANGPROJ15","معدل القسم");
define("LANGPROJ16","معدل تلميذ");
// ----------------------------------------------------------------------------
define("LANGDISP1","<font class=T2>  لا يوجد أي  التلميذ بهذا إسم </font>");
define("LANGDISP2","السبب");
define("LANGDISP3","شهادة طبية");
define("LANGDISP4","افترة&nbsp;في&nbsp;");
define("LANGDISP5","en المادة ");
define("LANGDISP6","ساعة من اعفاء ");
define("LANGDISP7","<B><font color=red>ب</font></B>ين في JJ/MM/AAAA  <BR> في 2 الميادين");
define("LANGDISP9","كشف <b>كامل</B>  للإعفاءات");
define("LANGDISP10","En");
// ----------------------------------------------------------------------------
define("LANGASS1","ترياد المساعدة");
define("LANGASS2","يقدم خدمة للتصليح ومساعدتكم في استخدام ترياد.<br /><br />لديكم مشكلة في احدى خدمات ترياد  ، يرجى مراسلتنا عن طريق الإستمارة التالة ، والمعلومات عن هذه الخدمة. مهندسينا سيتولون التحقق من هذه الخدمة.");
define("LANGASS3","عضو معني");
define("LANGASS4","هيئة الإ دارة");
define("LANGASS5","مدرس");
define("LANGASS6","  مدرسية الحياة");
define("LANGASS6bis","ولي");
define("LANGASS7","فعل");
define("LANGASS8","انجاز");
define("LANGASS9","مشاهدة");
define("LANGASS10","فسخ");
define("LANGASS11","أخرى");
define("LANGASS12","خدمة");
define("LANGASS13","حساب المستخدم");
define("LANGASS14","رسالةrie");
define("LANGASS15","تعيين");
define("LANGASS16","قاعدة بيانات");
define("LANGASS17"," قسم");
define("LANGASS18","المادة");
define("LANGASS19","البحث");
define("LANGASS20","D.S.T.");
define("LANGASS21","تنظيم");
define("LANGASS22","إعفاء");
define("LANGASS23","الانضباط");
define("LANGASS24","منشور");
define("LANGASS25","البطاقة");
define("LANGASS26","الفترة");
define("LANGASS27","تعليق");
define("LANGASS28","ترياد المساعدة تشكركم على مساعدتكم.");
define("LANGASS29"," فريق ترياد.");
define("LANGASS30","فريق ترياد في خدمتكم");
define("LANGASS31","ترياد هو فريد من نوعه وغير مسبوق ، لذلك ، يرجى موافاتنا بنصائح واقتراحات لتحقيق هذه الغاية ليتمكن الموقع تلبية توقعات المستخدمين الفعليين! شكرا لكم   : --)");
define("LANGASS32","الكتاب الذهبي");
define("LANGASS33","شهادتكم على المباشر : سجلوا التعليقات على الكتاب الذهبي.");
define("LANGASS34","الرسالة قد أرسلت إلينا ، فإننا سنعمل بالتأكيد على جوابكم.<br> <BR>أشكركم على استخدام ترياد و إلى اللقاء قريبا.<BR><BR><BR><UL><UL>فريق ترياد.<BR>");
define("LANGASS35","أخرى");
define("LANGASS36","الرسائل القصيرة");
define("LANGASS37","الواب");
define("LANGASS38","الصور");
define("LANGASS39","الباركود");
define("LANGASS40","تدريب المهني");
// -----------------------------------------------------------------------------
define("LANGRECH1","<font class=T2>لا يوجد أي تلميذ في القسم</font>");
define("LANGRECH2","البحث من ");
define("LANGRECH3","<font class=T2>لا يؤجد أي تلميذ لهذا البحث</font>");
define("LANGRECH4","معلومات / تغيير");
// ---------------------------------------------------------------------------------
define("LANGBASE1","تحذير : هذه الوحدة هي التي استخدمت خلال أول استخدام <br>يدمر كل المعلومات من التلاميذ (المذكرات والرسائل الإخبارية ، والحياة المدرسية).");
define("LANGBASE2"," الملفات التي سيتم استيرادها يجب تهيئة dbf ");
define("LANGBASE3","هنا هي قائمة الملفات ");
define("LANGBASE4"," GEP وحدة الملفات استيراد ");
define("LANGBASE5"," GEP استيراد قاعدة ");
define("LANGBASE6","إجمالي عدد التلاميذ في الملف DBF ");
define("LANGBASE7","إجمالي عدد التلاميذ في قسم ");
define("LANGBASE8","مجموع التلاميذ دون قسم");
define("LANGBASE9","استرداد كلمات السر  ");
define("LANGBASE10","غير قادر على فتح ملف F_ele.dbf");
define("LANGBASE11","قاعدة بيانات المعالجة -- فريق ترياد");
define("LANGBASE12","الملف المحدد غير صالح!");
define("LANGBASE13","هنا هي قائمة كلمات السر");
define("LANGBASE14","استرداد قائمة من خلال تحديد جميع خطوط وتقديم نسخ / لصق في ملف \"txt\".");
define("LANGBASE15","ثم باستخدام إكسل أو أوفيس ، استرداد الملف \"txt\"  en précisant في point virgule comme فاصل من الميادين.");
define("LANGBASE17"," تحذير : كلمات سر متاحة على <br />هذه صفحة !! تذكر للحصول على قائمة <b>AVANT</b> لإنهاء ");
define("LANGBASE18","معلومات غير متوافر");
// -----------------------------------------------------------------------------------------------------------------------
define("LANGBULL1","طباعة البطاقة الثلاثية");
define("LANGBULL2","بين القسم");
define("LANGBULL3","السنة الدراسية");
define("LANGBULL4","<a href=\"#\" onclick=\"open('./accrobat.php','acro','width=500,height=350')\"><b><FONT COLOR=red>حذار</FONT></B> يتطلب أداة <B>أدوبي أكروبات ريدر</B>. البرمجيات و التنزيل مجاني  انقر <B>هنا</B></A>");
// -----------------------------------------------------------------------------------------------------------------------
define("LANGPARENT1","أي رسالة");
define("LANGPARENT2","أي بعد تعيين المندوبين");
define("LANGPARENT3","تلميذ مندوب ");
define("LANGPARENT4","اولياء مندوبين");
define("LANGPARENT5","قائمة مندوبين");
//----------------------------------------------------------------------//
define("LANGPUR3","تحذير : هذا النموذج هو استخدام <br>عندما تريد محو البيانات ترياد");
define("LANGPUR4","تحذير ، يمكنك تشغيل في وحدة نمطية في نهاية المطاف ان حذف البيانات التي قمت بتحديدها.\\n هل تريد الإستمرار ؟ \\n\\n فريق ترياد");
define("LANGPUR5","البيانات تم فسخها");
define("LANGPUR6","المعلومات : اختيار \"التلاميذ\" يعني تلقائيا إلغاء الدرجات والغياب والانضباط ، والإعفاءات ، والتأخير ، والمقابلات ؛ ");
define("LANGPUR7","بين للعنصر أو العناصر التي دمر :  ");
define("LANGPUR8","للتخزين");
define("LANGPUR9","للحذف");
//----------------------------------------------------------------------//
define("LANGCHAN0","وحدة لتغيير القسم لواحد أو أكثر من التلاميذ");
define("LANGCHAN1","تحذير : هذا النموذج هو استخدام <br>عندما تريد <br>تغيير القسم للتلاميذ");
define("LANGCHAN3","الاهتمام ، ل \ 'مجموعة البيانات \' التلميذ \ \  أو التلاميذ المتضررين من تغيير القسم سيتم إزالتها");
//----------------------------------------------------------------------//
define("LANGGEP1",'استيراد ملف GEP');
define("LANGGEP2",'بين الملف  ');
//----------------------------------------------------------------------//
define("LANGCERT1"," تحميل الشهادة ");
//----------------------------------------------------------------------//
define("LANGPROFR1",'بين التلاميذ المتأخرين');
define("LANGPROFR2",'وضع التأخيرات  ');
define("LANGKEY1",'<font class=T1>لا يوجد مفتاح التسجيل  </font>');
define("LANGDISP20",'اضف اعفاءات');
define("LANGPROFA",'<br><center><font size=2>لا يوجد مفتاح التسجيل  </font><br><br>من فضلك بلغ مسؤول ترياد, <br>نهاية أكد طلب لتمكينك من تسجيل ترياد. </center><br><br>');
define("LANGPROFB",'أضف  عدد في ');
define("LANGPROFC",'تأكيد تسجيل الأعداد ');
define("LANGPROFD",'المصادقة على تسجيل الأعداد ');
define("LANGPROFE",'&nbsp;&nbsp;<i><u>معلومات</u>: مفتاح ادخل تمكنكم من المرور اليا إلى عدد الموالي.</i>');
define("LANGPROFF",'إضافة عدد');
define("LANGPROFG",'بين القسم');
//----------------------------------------------------------------------//
define("LANGMETEO1",'النهار');
define("LANGMETEO2",'الليل');
//----------------------------------------------------------------------//
define("LANGPROFP1","رسالة  الأقسام");
define("LANGPROFP2","سجل في رسالة");
define("LANGPROFP3","رسالة من الأستاذ العام");
//----------------------------------------------------------------------//
// Module تربص Pro
define("LANGSTAGE1","جدولة  التربصات ");
define("LANGSTAGE2","مشاهدة  تواريخ  التربصات ");
define("LANGSTAGE3","اضف ");
define("LANGSTAGE4","تعيين ");
define("LANGSTAGE5","ادخال  تاريخ التربص ");
define("LANGSTAGE6","تغيير  تاريخ التربص ");
define("LANGSTAGE7","إحذف  تاريخ التربص ");
define("LANGSTAGE8","إدارة  المؤسسات ");
define("LANGSTAGE9","مشاهدة مختلف المؤسسات ");
define("LANGSTAGE10","اضف شركة ");
define("LANGSTAGE11","تغيير شركة ");
define("LANGSTAGE12","إحذف شركة ");
define("LANGSTAGE13","إدارة التلاميذ ");
define("LANGSTAGE14","شاهد التلاميذ في شركة ");
define("LANGSTAGE15","تعيين تلميذ في شركة ");
define("LANGSTAGE16","تغيير ملامح  تلميذ ");
define("LANGSTAGE17"," إحذف إسناد  التلميذ");
define("LANGSTAGE18","مشاهدة تواريخ التربص");
define("LANGSTAGE19","تربص");
define("LANGSTAGE20","البحث d'مؤسسات");
define("LANGSTAGE21","تصفح  المؤسسات حسب نشاطها");
define("LANGSTAGE22","إستشارة المؤسسات");
//----------------------------------------------------------------------//
define("LANGGEN1","هيئة الإ دارة");
define("LANGGEN2","  مدرسية الحياة");
define("LANGGEN3","المدرسين");
//----------------------------------------------------------------------//
define("LANGDST1","طلب في D.S.T");
define("LANGDST2","مرحبا, <br> <br> طلبكم في فرض  القسم ليوم");
define("LANGDST3","<br><br><b>غ\ير ممكن</b>, من فضلك إختار تاريخ اخر أو اتصل بنا مباشرة. <br><br> شكرا");
define("LANGDST4","<br><br><b> مسجلة</b> لمزيد من المعلومات ، يرجى الاتصال بنا. <br><br> شكرا");
define("LANGDST5","لأجل");
define("LANGDST6","الموضوع / المادة");
define("LANGDST7"," طلب مرفوض");
define("LANGDST8","طلب مقبول");
//----------------------------------------------------------------------//
define("LANGCALEN1","الحدث");
define("LANGCALEN2","تنظيم  ");
define("LANGCALEN3","اضف مدخلات");
define("LANGCALEN4","إحذف مدخلات");
define("LANGCALEN5","تحديث صفحة");
define("LANGCALEN6","الجدول الزمني للأحداث");
define("LANGCALEN7"," قسم في ");
define("LANGCALEN8","إمتحان في ");
define("LANGCALEN9","فــروض القســـم الـيــــوم");
//----------------------------------------------------------------------//
//module reservation
define("LANGRESA1","إدارة المعدات");
define("LANGRESA2","إدارة القاعات");
define("LANGRESA3","قائمة المعدات");
define("LANGRESA4","قائمة القاعات");
define("LANGRESA5","اضف المعدات");
define("LANGRESA6","تغيير المعدات");
define("LANGRESA7","إحذف المعدات");
define("LANGRESA8","اضف قاعة");
define("LANGRESA9","إحذف قاعة");
define("LANGRESA10","إحذف قاعة");
define("LANGRESA11","الحجز جهاز / قاعة");
define("LANGRESA12","الحجز جهاز");
define("LANGRESA13","الحجز قاعة");
define("LANGRESA14","حجز");
define("LANGRESA15","انجاز المعدات");
define("LANGRESA16","إسم المعدات");
define("LANGRESA17","سجل انشاء");
define("LANGRESA18","معلومات إضافية");
define("LANGRESA19","تسجيل جهاز");
define("LANGRESA20","انجاز  قاعة");
define("LANGRESA21","إسم  القاعة");
define("LANGRESA22","قاعة المسجلة");
define("LANGRESA23","إحذف قاعة");
define("LANGRESA24","قاعة");
define("LANGRESA25","إحذف  القاعة");
define("LANGRESA26","قاعة حذف");
define("LANGRESA27"," قاعة");
define("LANGRESA28","لا يمكن حذف هذه قاعة. \\n\\n قاعة معينة.  ");
define("LANGRESA29","حذف الجهاز");
define("LANGRESA30","لا يمكن حذف هذا جهاز. \\n\\n جهاز معين  ");
define("LANGRESA31","المعدات");
define("LANGRESA32","إحذف جهاز");
define("LANGRESA33","جهاز");
define("LANGRESA34","إحذف المعدات");
define("LANGRESA35","قائمة الأجهزة");
define("LANGRESA36","تاريخ");
define("LANGRESA37","  مـن");
define("LANGRESA38","  إلـى");
define("LANGRESA39","من من");
define("LANGRESA40","معلومات");
define("LANGRESA41","تأكيد");
define("LANGRESA42","تأكيد");
define("LANGRESA43","إسم لتأكيد");
define("LANGRESA44","تنظيم جهاز");
define("LANGRESA45","جهاز");
define("LANGRESA46","المعدات  تم حجزها في ذلك التاريخ");
define("LANGRESA47","كشف الجدول الزمني للتحفظ لهذا  جهاز");
define("LANGRESA48","الحجز من  ");
define("LANGRESA49","مؤرخة ");
define("LANGRESA50","حجزت معدات تنتظر تأكيدا");
define("LANGRESA51","تنظيم قاعة");
define("LANGRESA52","قاعة");
define("LANGRESA53","قاعة  محفوظة لذلك التاريخ");
define("LANGRESA54","قاعة محفوظة في انتظار التأكيد ");
define("LANGRESA55","تصفح في جدول حجز هذه قاعة ");
define("LANGRESA56","تأكيد الحجز");
define("LANGRESA57","تنظيم");
define("LANGRESA58","تأكيد");
//----------------------------------------------------------------------//
define("LANGTTITRE1","دخول عضو");
define("LANGTTITRE2","عضو");
define("LANGTTITRE3","تنشيط الحساب");
define("LANGTTITRE4","شكرا للإتظار");
//--------------
define("LANGTP1","اللقب");
define("LANGTP2","إسم");
define("LANGTP3","كامة السر");
define("LANGTCONNEXION","ارتبــاط");
define("LANGTERREURCONNECT","غلط في ارتبــاط");
define("LANGTCONNECCOURS","في صدد الإرتبـاط ");
define("LANGTFERMCONNEC","اظغط هنا لإغلاق حسابك");
define("LANGTDECONNEC","الخروج في الأثناء");

define("LANGTBLAKLIST0",'<b><font color=red  class=T2>تم تعطيل حسابك!</b><br> لمصادقة حسابك, الاتصال بالمدرسة.</font>');

define("LANGMOIS1","جانفي");
define("LANGMOIS2","فيفري");
define("LANGMOIS3","مارس");
define("LANGMOIS4","أفريل");
define("LANGMOIS5","ماي");
define("LANGMOIS6","جوان");
define("LANGMOIS7","جويلية");
define("LANGMOIS8","أوت");
define("LANGMOIS9","سبتمبر");
define("LANGMOIS10","أكتوبر");
define("LANGMOIS11","نوفمبر");
define("LANGMOIS12","ديسمبر");
define("LANGDEPART1","للتلميذ");

define("LANGVALIDE","ابعث");
define("LANGIMP45","اعرض");

define("LANGMESS34","رسالة تعد متوفرة.");
define("LANGMESS35","إجعل هذه المجموعة للعامة.");
define("LANGMESS36","رسالة هحذوفة");


define("LANGRESA59","إسم القاعة");
define("LANGRESA60","معلومات");

define("LANGMAINT0","هذا التدخل هو مقرر في البرنامج");
define("LANGMAINT1","خدمة ترياد ستكون متوفرة في");
define("LANGMAINT2","ادخل");
define("LANGMAINT3","مع");

define("LANCALED1","السنة السابقة");
define("LANCALED2","السنة القادمة");


define("LANGTTITRE5","مشكل في الدخول ");
define("LANGTTITRE6","أسئلة");
define("LANGTPROBL1","حاليا ، خدمات ترياد في قيد الاستخدام.");
define("LANGTPROBL2","لدي سؤال");
define("LANGTPROBL3","تسجيل السؤال");
define("LANGTPROBL4","خروج دون تسجيل");
define("LANGTPROBL5","بينح لنا مشكلتك");
define("LANGTPROBL6","المعهد *: ");
define("LANGTPROBL7","العنوان الإكتروني : ");
define("LANGTPROBL8","رسالة : ");
define("LANGTPROBL9","(* ميدان اجباري)");
define("LANGTPROBL10","سجل المشكلة");
define("LANGTPROBL12","نتعهد بحل المشكلة في أقرب وقت ممكن. \\n\\n  فريق ترياد ");

define("LANGELEV1","الأعداد المدرسية ل");

define("LANGFORUM1","- قائمة رسائل");
define("LANGFORUM2","لا توجد رسائل تم نشرها في هذا المنتدى");
define("LANGFORUM3","يمكنك ");
define("LANGFORUM3bis"," ابعث ");
define("LANGFORUM3ter"," الرسالة الأولى إذا كنت ترغب ");
define("LANGFORUM4","بعث رسالة جديدة");
define("LANGFORUM5","منتدى -- نشر رسالة");
define("LANGFORUM6","احترام الميثاق");
define("LANGFORUM7","خطأ: الرسالة  مشار إليها غير موجودة.");
define("LANGFORUM8","العودة إلى قائمة الرسائل المنشورة");
define("LANGFORUM9","--- الرسالة الأصلية  ---");
define("LANGFORUM10","إسمك ");
define("LANGFORUM11"," العنوانك الإكتروني ");
define("LANGFORUM12","الموضوع ");
define("LANGFORUM13","ابعث"); // --> bouton envoyer
define("LANGFORUM14","العودة إلى قائمة الرسائل المنشورة");
define("LANGFORUM15","منتدى -- إرسال رسالة");
define("LANGFORUM16","<b>خطأ</b> : هذه صفحة لا يمكن استدعاؤها<br> اذا كانت هناك رسالة كان سابقا ");
define("LANGFORUM16bis"," نشر ");
define("LANGFORUM17","<b>خطأ</b> : رسالتك لا يوجد فيها نص.<br>");
define("LANGFORUM18","<b>خطأ</b> : كنت قد نسيت أن تدرج اسمك.<br>");
define("LANGFORUM19","خطأ !  رسالتك لم يتم نشرها. ");
define("LANGFORUM20","<b>خطأ</b> : غير قادر على تحديث ملف الفهرس. <br>");
define("LANGFORUM21"," رسالتك لم يتم نشرها.");
define("LANGFORUM22","رسالتك لقد تم نشرها بشكل صحيح.<br>شكرا لمساهمتك.");
define("LANGFORUM23","العودة إلى قائمة الرسائل المنشورة");
define("LANGFORUM24","منتدى -- قراءة رسالة");
define("LANGFORUM25","لا توجد رسائل تم نشرها في هذا المنتدى.");
define("LANGFORUM26","يمكنك ");
define("LANGFORUM26bis","ركز");
define("LANGFORUM26ter","الرسالة الأولى إذا كنت ترغب.");
define("LANGFORUM27","هذه رسالة لا وجود لها أو تم حذفه من قبل إدارة المنتدى.<br>");
define("LANGFORUM28","العودة إلى قائمة الرسائل المنشورة");
define("LANGFORUM30","كاتب");
define("LANGFORUM31","تاريخ");
define("LANGFORUM32","اكتب جواب");
define("LANGFORUM33","الرسالة السابقة (في الموضوع)");
define("LANGFORUM34","الرسالة التالية (في الموضوع)");

define("LANGPROFH","القيام بالواجب المدرسة في ");
define("LANGPROFI","تسجيل واجب المدرسي");
define("LANGPROFJ","واجب منزلي ");
define("LANGPROFK","saisie&nbsp;في&nbsp;");
define("LANGPROFL","تأكيد التاريخ");
define("LANGPROFM","لأجل");
define("LANGPROFN","فرض في ");
define("LANGPROFO","فرض مدرسي ");
define("LANGPROFP","وضع الأساتذة العامين");
define("LANGPROFQ","للغد");
define("LANGPROFR","للأمس");
define("LANGPROFS","المادة أو موضوع");
define("LANGPROFT","ابعث الطلب في D.S.T");
define("LANGPROFU","المطلب أرسل -- فريق ترياد");


define("LANGPROJ17","عدد الغيابات");
define("LANGPROJ18","أيام");

define("LANGCALEN10","رزنامة فروض القسم");

define("LANGPARENT6","قائمة  التأخيرات");
define("LANGPARENT7","قائمة  الغيابات");
define("LANGPARENT8","غائب في ");
define("LANGPARENT9","قائمة  الإعفاءات");
define("LANGPARENT10","افترة&nbsp;في&nbsp;");
define("LANGPARENT11","  إلـى"); // indique une تاريخ (ساعة)
define("LANGPARENT12","في"); // indique une تاريخ يوم
define("LANGPARENT13","شهادة");
define("LANGPARENT14","عقوبة تأديبية");
define("LANGPARENT15","عقوبة");
define("LANGPARENT16","في&nbsp;الإحتفاظ");
define("LANGPARENT17","إلى");  // indique une ساعة
define("LANGPARENT18"," اجرى الإحتفاظ");
define("LANGPARENT19","قائمة المناشير الإدارية");
define("LANGPARENT20","الدخول إلى الملف");
define("LANGPARENT21","واضحة من طرف ");
define("LANGPARENT22","الجدول الزمني للأحداث ");
define("LANGPARENT23","رزنامة فروض القسم ");
define("LANGPARENT24","طلب في D.S.T ");


define("LANGAUDIO1","بلاغ سمعي");
define("LANGAUDIO2","في "); // indique une تاريخ
define("LANGAUDIO3","C"); // première lettre
define("LANGAUDIO3bis","بلاغ سمعي <b>mp3</b><br>حجم الحد الأقصى ملف : ");
define("LANGAUDIO4","تسجيل البلاغ");
define("LANGAUDIO5","من فضلك انتظر 2 إلى 3 دقائق بعد ارسال الملف سمعي.");
define("LANGAUDIO6","إحذف في بلاغ سمعي");


define("LANGOK","موافق");
define("LANGCLICK","انقر هنا");
define("LANGPRECE","السابق");
define("LANGERROR1","معطيات غير موجمدة");
define("LANGERROR2","لا يوجد بينات");


define("LANGPROF1","بين  المادة");
define("LANGPROF2","عدد من الأعداد");
define("LANGPROF3","مشاهدة الأعداد");
define("LANGPROF4","مجموعة");
define("LANGPROF5","اختيار الثلاثي");
define("LANGPROF6","الموضوع "); // sujet du إمتحان 
define("LANGPROF7","إسم الإمتحان "); // sujet du إمتحان 
define("LANGPROF8","عدد"); //عدد d'un إمتحان 
define("LANGPROF9","فرض مدرسي   للقيام به في  المنزل");
define("LANGPROF10","تغيير عدد");
define("LANGPROF11","فسخ إمتحان"); // devoir --> interrogation
define("LANGPROF12","أستاذ عام");
define("LANGPROF13","بطاقة تلميذ");
define("LANGPROF14","اضف عدد في ");
define("LANGPROF15","تغيير  عدد في");
define("LANGPROF16","إسم الفرض");
define("LANGPROF17","تاريخ&nbsp;&nbsp;فرض"); // &nbsp; --> égal un blanc
define("LANGPROF18","انتظر");
define("LANGPROF19","تأكيد تغيير الأعداد");
define("LANGPROF20","ابعث تغيير  الأعداد");
define("LANGPROF21","تغيير  الأعداد في");
define("LANGPROF22","مشاهدة الأعداد في");
define("LANGPROF23","فسخ إمتحان في");
define("LANGPROF24","إمتحان في "); // interrogation du
define("LANGPROF25","حذف");
define("LANGPROF26","معلومات عن التلميذ");
define("LANGPROF27","إرشادات إدارية");
define("LANGPROF28","معلومات عن الحياة المدرسية");
define("LANGPROF29","معلومات طبية");
define("LANGPROF30","معلومات من");
define("LANGPROF31","  مـن"); // indiquant une personne


define("LANGEL1","إسم");
define("LANGEL2","الإسم");
define("LANGEL3"," قسم ");
define("LANGEL4","Lv1");
define("LANGEL5","Lv2");
define("LANGEL6","إختيار");
define("LANGEL7","نظام");
define("LANGEL8","تاريخ الولادة");
define("LANGEL9"," جنسية");
define("LANGEL10","كلمة السر");
define("LANGEL11","لقب العائلة");
define("LANGEL12","الإسم");
define("LANGEL13","نهج");
define("LANGEL14","العنوان 1");
define("LANGEL15","الرقم البريدي");
define("LANGEL16","البلدة");
define("LANGEL17","نهج");
define("LANGEL18","العنوان 2");
define("LANGEL19","الرقم البريدي");
define("LANGEL20","البلدة");
define("LANGEL21","الهاتف");
define("LANGEL22","مهنة الأب");
define("LANGEL23","الهاتف الأب");
define("LANGEL24","مهنة الأم");
define("LANGEL25","الهاتف الأم");
define("LANGEL26","المعهد");
define("LANGEL27","رقم المعهد");
define("LANGEL28","الرقم البريدي");
define("LANGEL29","البلدة");
define("LANGEL30","رقم التلميذ");
// define("LANGEL30","رقم National");


define("LANGPROF32","معلومات المدرسية");
define("LANGPROF33","واجب منزلي");
define("LANGPROF34","معاينة أسبوعية");
define("LANGPROF35","الأسبوع الماضي");
define("LANGPROF36","الأسبوع القادم");
define("LANGTP23"," إعلام -- طلب حجز!");
define("LANGRESA61","إسم المعدات");


define("LANGIMP46","الإسم");
define("LANGIMP47","إسم (السيد. أو السيدة أو الآنسة) ");
define("LANGIMP48","اللقب");
define("LANGIMP49","* ميدان اجباري");
define("LANGIMP50","ملف للإرسال <FONT color=RED><B>يجب</B></FONT> يحتوي <FONT COLOR=red><B>9</B></FONT> الميادين <I>(لا vides)</I> مفصولة بنفس الفاصل \"<FONT color=red><B>;</B></font>\" <I>اما وجود 8 مرات في حرف \"<FONT color=red><B>;</B></font>\"</I>");
define("LANGIMP51","كلمة السر الولي");
define("LANGIMP52","كلمة السر التلميذ");



define("LANGacce_dep1","غلط في الإرتبـاط");
define("LANGacce_dep2","التحقق من تسجيل الدخول الخاص بك ، وإذا استمرت المشكلة ، تخبر <br/> ترياد مسؤول عن طريق الوصلة <br/> 'مشاكل الوصول' في القائمة اليسرى");

define("LANGacce_ref1","نوع الخطأ : الوصول غير المصرح به");
define("LANGacce_ref11","وقعت الزيارة في");
define("LANGacce_ref12","من طرف ");
define("LANGacce_ref13","مع  ");
define("LANGacce_ref2","دخول غير مصرح به");
define("LANGacce_ref3","للوصول إلى حسابك ، يجب عليك تسجيل الدخول.");
define("LANGacce1","التلميذ ");
define("LANGacce12","عقوبة  للإرجاع عنده(ها)<br>الفئة التالية :");
define("LANGacce13","لأجل سبب ");
define("LANGacce14","الفرض المطلوب هو التي:");
define("LANGacce2","إحذف ce رسالة : ");
define("LANGacce21","إحذف");
define("LANGacce3","التلميذ ");
define("LANacce31","لم يحضر</b></font> في الحياة المدرسية (CPE), <b> للإحتفاظ</b>,  من أجل الفئة");
define("LANacce32","لأجل سبب : ");
define("LANGacce4","الفرض المطلوب هو التي:");
define("LANGacce5","إحذف");
define("LANGacce6","إدارة تأدبية");
define("LANGaccrob11","تنزيل البرمجيات أدوبي أكروبات ريدر 8.1.0 fr");
define("LANGaccrob2","23,4 Mo  pour Windows 2000/XP/2003/Vista");
define("LANGaccrob3","وقت التنزيل");
define("LANGaccrob4","en 56 K : 57 min مع 3 s");
define("LANGaccrob5","en 512 K : 6 min مع 14 s");
define("LANGaccrob6","en 5 M : 37 secondes");
define("LANGaccrob7","تنزيل البرمجيات أدوبي أكروبات ريدر 6.O.1 fr");
define("LANGaccrob8","حجم : ");
define("LANGaccrob9","0.40916 Mo pour NT/95/98/2000/ME/XP");
define("LANGaccrob10","en 56 K : 0 min مع 58.2 s");
define("LANGaccrob11bis","en 512 K : 0 min مع 6.6 s ");
define("LANGaffec_cre21","انجاز تعيين  الأقسام ");
define("LANGaffec_cre22","وضع التعيين جاري ");
define("LANGaffec_cre23","إطلاق برنامج التعين سيتم تلقائيا <br>إذا كانت صفحة جديدة لا تظهر ، انقر  ");
define("LANGaffec_cre24"," حساب ترياد -  ");
define("LANGaffec_cre31","تكوين ـ تعيين");
define("LANGaffec_cre41","اطبع");
define("LANGaffec_mod_key1","تعيين des الأقسام");


define("LANGaffec_mod_key2","وحدة  تغيير تعيين  الأقسام.");
define("LANGaffec_mod_key3","تحذير هذه الوحدة تستخدم عند تغيير التعيين<br> إنه يحذف كل أعداد تلاميذ الأقسام المعدلة ");
define("LANGaffec_mod_key4","تحذير, تدمير كل أعداد  الأقسام المختارة  سيقع فسخها. \\n هل تريد الإستمرار ؟ \\n\\n فريق ترياد");
define("LANGattente1","إنتظار - ترياد");
define("LANGattente2","من فضلك انتظر, من فضلك");
define("LANGattente3","فريق ترياد.");
define("LANGatte_mess1","ترياد - إنتظار - رسائل");
define("LANGatte_mess2","من فضلك انتظر, من فضلك");
define("LANGatte_mess3","خدمات ترياد");
define("LANGbasededon20","ابعث  الملف");
define("LANGbasededon201","لا شيئ");
define("LANGbasededon2011","استيراد ملف GEP");
define("LANGbasededon202","مذكرةاحيلت -- فريق ترياد");
define("LANGbasededon203","مذكرةلا مسجلة");
define("LANGbasededon31","بين لكل مرجع القسم المناظر");
define("LANGbasededon32","اختيار ...");
define("LANGbasededon33","أي");
define("LANGbasededon34","إرسال ملف يمكن أن يدوم من <b>2 إلى 4 دقائق</b> حسب عدد التلاميذ.");
define("LANGbasededon35","الملف يجب أن يكون مهيأ <b>dbf</b> و يجب أن يكون <b>F_ele.dbf</b>");
define("LANGbasededon41","!!!  خطأ في عدد  الأقسام - اتصل فريق ترياد <br /><br /> support@triade-educ.com</center>");
define("LANGbasededon42","خطأ في كتابة الأقسام , قسم واحد يتكرر عدة مرات -- فريق ترياد");
define("LANGbasededon43","رسالة من : ");
define("LANGbasededon44","  مـن");
define("LANGbasededon45","عضو :");
define("LANGbasededon46","رسالة :");
define("LANGbasededon47","قاعدة جديدة :");
define("LANGbasededon48","- مع GEP");
define("LANGbasededon49"," المعهد :");
define("LANGbasededoni11","'تحذير','./image/commun/warning.jpg','<font face=Verdana size=1><font color=red>ا</font>لوحدة <b>dbase</b> ليس <br> chargé !! <i> مطلوب للإستراد<br> قاعدة GEP.");
define("LANGbasededoni21","تحذير, تدمير القاعدة القديمة  يكون تلقائي. \\n هل تريد الإستمرار ؟ \\n\\n L\' فريق ترياد");
define("LANGbasededoni31","بين إلى أية فئة يتم تعيين الملف  ");
define("LANGbasededoni32","توريد الملف المعني : ");
define("LANGbasededoni33","توريد التلاميذ : ");
define("LANGbasededoni34","توريد الأساتذة :");
define("LANGbasededoni35","توريد الموظفون الحياة المدرسية : ");
define("LANGbasededoni36","توريد الموظفون الإداريون : ");
define("LANGbasededoni41"," قسم السابق");
define("LANGbasededoni42","السنة السابقة");
define("LANGbasededoni51","لتسمية");

define("LANGbasededoni61","خطأ");
define("LANGbasededoni71","استيراد ملف ASCII");
define("LANGbasededoni72","رسالة من : ");
define("LANGbasededoni721","  مـن");
define("LANGbasededoni722","عضو :");
define("LANGbasededoni723","رسالة :");
define("LANGbasededoni724","قاعدة جديدة :");
define("LANGbasededoni725","-    ASCII مع ");
define("LANGbasededoni726"," المعهد :");
define("LANGbasededoni73","إجمالي السجلات في قاعدة البيانات");
define("LANGbasededoni91","استيراد ملف ASCII");
define("LANGbasededoni92","!!!  خطأ في عدد  الأقسام - اتصل ب فريق ترياد <br />");
define("LANGbasededoni93","خطأ في كتابة الأقسام , قسم واحد يتكرر عدة مرات -- فريق ترياد");
define("LANGbasededoni94","قاعدة البيانات المجهزة -- فريق ترياد<br />");
define("LANGbasededoni95","مجموع مسجلة التلميذ في قاعدة البيانات :");
define("LANGPIEDPAGE","<p> الشفافية وحسن التوقيت المعلوماتية لأغراض التعليم<br>لمشاهدة هذا الموقع على النحو الأمثل :  التصميم الأدنى : 800x600 <br>  © 2000 - ".date("Y")."  -تريادجميع الحقوق محفوظة");

define("LANGAPROPOS1","نسخة");
define("LANGAPROPOS2","جميع الحقوق محفوظة");
define("LANGAPROPOS3","رخصة استخدام ");
define("LANGAPROPOS4","معرف المنتج");

define("LANGTELECHARGER","تنزيل");
define("LANGAJOUT1","لأجل نظام الاختيار (<b>INT</b> (مقيم),<b>EXT</b> (خارجي), <b>DP</b> (نصف مقيم)<br><br>");
define("LANGIMP44","الملف لا يتطابق.");
define("LANGBASE16"," الأعمدة ممثلة على النحو التالي : <b>لقب الدخول ; إسم الدخول ; كلمة السر الولي ; كلمة السر تلميذ غير مشفرة</b>");


define("LANGSUPP0","فسخ حساب نائب");
define("LANGSUPP1","وحدة فسخ");
define("LANGSUPP2","احذف العضو");
define("LANGSUPP3","هل تريد حذف من قائمة  المناوبين");
define("LANGSUPP3bis","استبدال");
define("LANGSUPP4","تأكيد  الفسخ");
define("LANGSUPP5","تعذر حذف هذا الحساب . \\n\\n حساب انتدب للعمل في قسم.  \\n\\n  فريق ترياد");
define("LANGSUPP6","حساب محذوف -- فريق ترياد");
define("LANGSUPP7","فسخ  مجموعة");
define("LANGSUPP8","إحذف في مجموعة");
define("LANGSUPP9","فسخ حساب ");
define("LANGSUPP10","إحذف العضو");
define("LANGSUPP11","عضوا في الحياة المدرسية");
define("LANGSUPP12","مسؤول");
define("LANGSUPP13"," أستاذ");
define("LANGSUPP14","فسخ  تلميذ من قسم");
define("LANGSUPP15","انقر على التلميذ للحذف");
define("LANGSUPP16","فسخ  تلميذ");
define("LANGSUPP17","سوف يتم إزالته من قاعدة");
define("LANGSUPP18","سوف تحذف جميع المعلومات حول هذا التلميذ   ، وهما : <br> (الأعداد, الغيابات, التأخيرات, اعفائات, عقوبات, معلومات, رسائل, ...)");
define("LANGSUPP19","إلغاء  الفسخ");
define("LANGSUPP20","حذف القاعدة");
define("LANGSUPP21","إحذف  قسم");
define("LANGSUPP22","فسخ  قسم");
define("LANGSUPP23","فسخ  مادة أو  المادة الفرعية");
define("LANGSUPP24","إحذف  المادة");
define("LANGSUPP25","القسم حذف --  خدمات ترياد");
define("LANGSUPP26","المادة حذف --  خدمات ترياد");
define("LANGSUPP27","انجاز مادة");
define("LANGSUPP28"," المادة الفرعية المسجلة");

define("LANGADMIN","المدير");
define("LANGPROF","مدرس");
define("LANGSCOLAIRE","   مدرسية الحياة");
define("LANGالقسم"," قسم");


define("LANGGRP11","إسم  المجموعة");
define("LANGGRP12","الأقسام المعنية");
define("LANGGRP13","قائمة التلاميذ");
define("LANGGRP14","قائمة مجموعات");
define("LANGGRP15","انجاز  مجموعة");
define("LANGGRP16","بين التلاميذ  في مجموعة");
define("LANGGRP17","حدد");
define("LANGGRP18","سجل المجموعة");
define("LANGGRP19","وقع انجاز  مجموعة ");
define("LANGGRP20","اخرى مجموعة");
define("LANGGRP21","قائمة المجموعات");
define("LANGGRP22","بين  قسم  لانشاء  مجموعة من فضلكم \\n\\n فريق ترياد");
define("LANGGRP23","قائمة تلاميذ المجموعة");
define("LANGGRP24","قائمة الأقسام");
define("LANGGRP25","قائمة  المواد");



//----------------//
define("LANGDONNEENR","<font class=T2>البيانات المسجلة.</font>");

define("LANGABS47","إضافة عقوبة تأديبية");
define("LANGABS48"," الذي تم التوصل إليه ");
define("LANGABS48bis","مرة  في فئة");
define("LANGABS49","المدة");
define("LANGABS50"," الإحتفاظ  في ");
define("LANGABS51"," هاتف.  مهنة الأب ");
define("LANGABS52"," هاتف.  مهنة الأم ");
define("LANGABS53","لا يوجد تأخير أو غياب يذكر");

define("LANGCALRET1","رزنامة &nbsp;  &nbsp; الإحتفاظ");

define("LANGHISTO1","تاريخ  العمليات");

define("LANGDST9","اضف مدخلات");
define("LANGDST10","إحذف مدخلات");
define("LANGDST11","في قسم");

define("LANGDISP11","كشف <b>كامل</B>  للإعفاءات");

define("LANGEN","En");

define("LANGAFF4","كشف قسم");
define("LANGAFF5","كل الأقسام");
define("LANGAFF6","عاين هذا القسم");

define("LANGCHER1","البحث المعقد");
define("LANGCHER2","بين  شكل الملف  للتوليد");
define("LANGCHER3","بين  فاصل  الميادين");
define("LANGCHER4","قم بالبحث عن إسم التلميذ    : <b>انقر هنا</b>");
define("LANGCHER5","اضف");
define("LANGCHER6","إحذف");
define("LANGCHER7","إصعد");
define("LANGCHER8","إنزل");
define("LANGCHER9","التالي");
define("LANGCHER10","عنصر البحث");
define("LANGCHER11","البحث عن عدد  معايير ");
define("LANGCHER12","من");

define("LANGCHER13","مع القيمة");
define("LANGCHER14","البحث التقريبي");
define("LANGCHER15","البحث الدقيق");
define("LANGCHER16","إبدأ البحث");
define("LANGCHER17","تحذير: لا يزال عنصر غير مختار !! -- فريق ترياد ");

define("LANGCHER18","وحيث القيمة");

define("LANGTITRE34","تكوين رسائل تأخير");
define("LANGTITRE35","تكوين رسائل غياب");

define("LANGCONFIG1","تكوين المسجلة.");
define("LANGCONFIG2","هذا هو نصك ");

define("LANGCONFIG3","بين  قائمة أولياء التلاميذ الذين سيحصلون على رسالة");

define("LANGERROR01","خطأ الدخول إلى القاعدة");
define("LANGERROR02","حذار غير ممكن <br><br>هذه المشكلة قد تأتي من المعلومات المعروضة <br>(التحقق من الميادين المختلفة قبل التأكد).<BR>  <BR>أو هو بالفعل المعلومة امسجلة أو  يتعذر الوصول إليها.");
define("LANGERROR03","غير قادر على الوصول إلى القاعدة لهذا الإجراء. <BR>");

define("LANGABS54","غائب (ة)مسجل .");
define("LANGABS55"," مسجل (ة) تأخير.");


define("LANGPARAM4","شهادة بالفعل مسجلة.");
define("LANGPARAM5","شهادة مدرسية تلاميذ  القسم ");
define("LANGPARAM5bis","متوفر في شكل PDF");
define("LANGPARAM6","الإعداد لمضمون البطاقات والفترات");

define("LANGPARAM7","اسم مدير المعد");
define("LANGPARAM8","اسم المعهد");
define("LANGPARAM9","العنوان");
define("LANGPARAM10","الرقم البريدي");
define("LANGPARAM11","البلدة");
define("LANGPARAM12","الهاتف");
define("LANGPARAM13","العنوان الإلكترني");
define("LANGPARAM14","رمز المعهد");
define("LANGPARAM15"," سجل الإعدادات ");
define("LANGPARAM16","وقع التسجيل. -- فريق ترياد");

define("LANGCERTIF1","شهادة مدرسية في ");
define("LANGCERTIF1bis","متوفر في شكل PDF");


define("LANGRECHE1","معلومات عن التلميذ");

define("LANGBT52","تغيير المعطيات");

define("LANGEDIT1","معطيات غير موجمدة");

define("LANGMODIF1","تحديث حساب تلميذ");
define("LANGMODIF2","ارشادات عن التلميذ");
define("LANGMODIF3","ارشادات عن العائلة");

define("LANGALERT1","تحديث البيانات  --  فريق ترياد");
define("LANGALERT2","علما تنسيق الملف لا يتوافق أو  عدم احترام الحجم");
define("LANGALERT3","علما تنسيق الملف لا يتوافق أو  عدم احترام الحجم");

define("LANGLOGO1","شعار للإرسال");
define("LANGLOGO2","سجل  الشعار");
define("LANGLOGO3","الشعار <b>يجب أن يكون في شكل jpg</b>  و  حجم 96px على 96px.");

define("LANGPARAM17","تعريف الفترات ثلاثي  أو سداسي ");
define("LANGPARAM18","الثلاثي أو السداسي");
define("LANGPARAM19","تاريخ  بداية");
define("LANGPARAM20","تاريخ  نهاية");
define("LANGPARAM21","الأول");
define("LANGPARAM22","الثاني");
define("LANGPARAM23","الثالث");
define("LANGPARAM24","سجل تواريخ الثلاثيات");
define("LANGPARAM25","البيانات تؤخذ بعين الاعتبار إذا كانت مسجلة  في الشكل الثلاثي");
define("LANGPARAM26","تاريخ غير صالح --  فريق ترياد");
define("LANGPARAM27","معلومات مسجلة --  فريق ترياد");
define("LANGPARAM28","ثلاثي");
define("LANGPARAM29","السداسي");
define("LANGPARAM30","البطاقة");


define("LANGBULL5","طبع البطاقة");
define("LANGBULL6","واصل العلاج");
define("LANGBULL7","الطباعة فترة");
define("LANGBULL8","بين إلى فترة البداية   ");
define("LANGBULL9","بين إلى فترة النهاية  ");
define("LANGBULL10","بين إلى فترة");
define("LANGBULL11","بين إلى شعبة");
define("LANGBULL12","اطبع la فترة");
define("LANGBULL13","التاريخ");
define("LANGBULL14","<FONT COLOR='red'>حذار</FONT></B> يتطلب أداة <B>أدوبي أكروبات ريدر</B>.  مع تحميل البرمجيات الحرة ");
define("LANGBULL14bis","تنزيل");
define("LANGBULL15","معاينة / إحذف");
define("LANGBULL16","إسم التلميذ");
define("LANGBULL17","أستاذ");
define("LANGBULL18","تفاصيل الأعداد");
define("LANGBULL19","ملاحظة الأستاذ العام");
define("LANGBULL20","دفتر الأعداد");
define("LANGBULL21","فترة");

define("LANGBULL22"," الثلاثي الأول ");
define("LANGBULL23","ثلاثي الثاني ");
define("LANGBULL24","ثلاثي الثالث ");

define("LANGBULL25","الأول السداسي");
define("LANGBULL26","الثاني السداسي");

define("LANGBULL27","بطاقة  ");
define("LANGBULL28","شعبة");
define("LANGBULL29","السنة الدراسية");

define("LANGBULL30","البطاقة");

define("LANGBULL31","تلميذ");
define("LANGBULL32","مواد");
define("LANGBULL33"," قسم");
define("LANGBULL34","التقييمات ، والتقدم ، نصائح من أجل التقدم");

define("LANGBULL35","ضارب");
define("LANGBULL36","معدل");
define("LANGBULL37","أدنى");
define("LANGBULL38","أقصى");
define("LANGBULL39","الحضور مع السلوك داخل المعهد : ");
define("LANGBULL40","التقييم الشامل لفريق التدريس : ");
define("LANGBULL41","البطاقة لإبقائها آمنة");
define("LANGBULL42","تأشيرة مدير المعهد أو من ينوبه");
define("LANGBULL43","العام المدرسي");
define("LANGBULL44","السيد. & السيدة");
define("LANGOU","أو"); // في أو من ou bien


define("LANGPROJ19","السداسي 1");
define("LANGPROJ20","السداسي 2");

define("LANGDISC1","الإحتفاظ  في ");
define("LANGDISC2","اطبع  الإحتفاظات اليومية");


define("LANGDISC3"," هاتف. المنزل ");
define("LANGDISC4"," هاتف.  مهنة. الأب ");
define("LANGDISC5"," هاتف.  مهنة. الأم ");
define("LANGDISC6","انشاء عقوبة في القسم  ");
define("LANGDISC7","عنوان الفئة ");
define("LANGDISC8","عنوان عقوبة ");
define("LANGDISC9","إسناد من طرف ");
define("LANGDISC10","السبب, معلومات, القيام بفرض");
define("LANGDISC11","الإحتفاظ");
define("LANGDISC11bis","في");  // في pour بين une تاريخ
define("LANGDISC11Ter","  إلـى");  // A pour بين une ساعة
define("LANGDISC12","المدة");
define("LANGDISC13","<font color=red>ض</font></B>ع علامة في المربع اذا كان التلميذ هو إما محتفظ أو معاقب.");
define("LANGDISC14","إضافة عقوبة تأديبية");
define("LANGDISC15","<B>*<I> D</B>: الهاتف المنزل, <B>P</B>: الهاتف مهنة الأب, <B>M</B>: الهاتف مهنة الأم</I>");
define("LANGDISC16","قم ب");
define("LANGDISC17"," هاتف.");
define("LANGDISC18","كشف   العقوبات");
define("LANGDISC19","كشف  <b>5</B> آخر العقوبات");
define("LANGDISC20","الفئة");
define("LANGDISC21","قائمة كاملة  ");
define("LANGDISC22","معاينة  إحتفاظات  ");
define("LANGDISC23","كشف  الإحتفاظ");
define("LANGDISC24","كشف  <b>كامل</B>  الإحتفاظ");
define("LANGDISC25","في&nbsp;الإحتفاظ");
define("LANGDISC26","الإحتفاظ لم يقع");
define("LANGDISC27","قائمة العقوبات  ");
define("LANGDISC28","كشف  العقوبات");
define("LANGDISC29","كشف  <b>كامل</B>  العقوبات");
define("LANGDISC30","Saisie&nbsp;في");
define("LANGDISC31","قائمة العقوبات ");
define("LANGDISC32","الإحتفاظ لم يقع   لتلميذ ");
define("LANGDISC33","حذار تلميذ ");
define("LANGDISC33bis","   الإحتفاظ التاريخ و الساعة المشارة إليها. ");
define("LANGDISC34","الذي تم التوصل إليه");
define("LANGDISC34bis","مرة  في فئة");
define("LANGDISC35","فسخ عقوبة");
define("LANGDISC36","فسخ الإحتفاظe");

define("LANGattente222","انتظر");



define("LANGSUPP","إحذف"); // abréviation من إحذف



define("LANGCIRCU1","إدارة المناشير الإدارية");
define("LANGCIRCU2","اضف منشور");
define("LANGCIRCU3","قائمة المناشير");
define("LANGCIRCU4","إحذف منشور");
define("LANGCIRCU5","اضافة مناشير إدارية");
define("LANGCIRCU6","الموضوع");
define("LANGCIRCU7","لمرجعية");
define("LANGCIRCU8","منشور");
define("LANGCIRCU9","سلك المدرسين");
define("LANGCIRCU10","في قسم أو أقسام");
define("LANGCIRCU11","<font face=Verdana size=1><B><font color=red>م</font></B>نشور في شكل : <b> doc</b>, <b>pdf</b>, <b>txt</b>.</FONT>");
define("LANGCIRCU12","<font face=Verdana size=1><B><font color=red>ا</font></B>لمناشير ظاهرة  للأساتذة.</FONT>");
define("LANGCIRCU13","كل الأقسام");
define("LANGCIRCU14","العودة إلى الائحة");
define("LANGCIRCU15","سجل المنشور");
define("LANGCIRCU16","منشور غير المسجل");
define("LANGCIRCU17","الملف يجب أن يكون مهيأ <b>txt ou doc ou pdf</b> أقل من 2Mo ");
define("LANGCIRCU18","<font class=T2>منشور المسجل</font>");
define("LANGCIRCU19","حذف المناشير الإدارية");
define("LANGCIRCU20","الدخول إلى الملف");
define("LANGCIRCU21","<font color=red>ا</b></font><font color=#000000>لمرجعية");

define("LANGCODEBAR1","إدارة باركودات");
define("LANGCODEBAR2","هذه الوحدة لا تعمل مع الخادمك. <br> تحتاج PHP 5 او ما فوق لاستخدام هذه الوحدة.");
define("LANGCODEBAR3","هذه قائمة في متناول باركودات ترياد");
define("LANGCODEBAR4","شريط الرموز المستخدمة الافتراضي هو");
define("LANGCODEBAR5","قائمة");


define("LANGPUB1","إضافة راية إعلان");
define("LANGPUB2","هل تريد النشر على موقع ترياد");
define("LANGPUB3","قم بحملة إشهارية");
define("LANGPUB4","لهذا  ");
define("LANGPUB5","كنت بالفعل المعلنين على ترياد ");

define("LANGPROFB1","ملاحظات  للبطاقات الثلاثية");
define("LANGPROFB2","إعداد  ملاحظاتكم اليا ");
define("LANGPROFB3","إعداد");
define("LANGPROFB4","تكوين ملاحظات البطاقات");
define("LANGPROFB5","تسجيل الملاحظات");
define("LANGPROFB6","تعليق");
define("LANGPROFB7","قائمة");


define("LANGPROFC1","رزنامة جدول الجهاز");
define("LANGPROFC2","رزنامة جدول القاعات");


define("LANGPARAM31","طريقة مشاهدة U.S.A.");
define("LANGPARAM32","الحضور مع السلوك داخل المعهد : ");
define("LANGPARAM33","تحصيل ملف PDF");

define("LANGDISC37","إضافة عقوبة تأديبية");

define("LANGPROFP4","<b>أستاذ عام</b> في ");
define("LANGPROFP5","معلومات عن التلميذ");
define("LANGPROFP6","معلومات  ");
define("LANGPROFP7","حتى ");

define("LANGPROFP8","مجموع عدد التأخيرات");
define("LANGPROFP9","عدد التأخيرات في هذا ثلاثي");
define("LANGPROFP10","مجموع عدد  الغيابات");
define("LANGPROFP11","عدد الغيابات في هذا ثلاثي");

define("LANGPROFP12","إدارة المندوبين");
define("LANGPROFP13","  في قسم  ");
define("LANGPROFP14","ولي مندوب");
define("LANGPROFP15","جهة اتصال");
define("LANGPROFP16","مندوب تلميذ");
define("LANGPROFP17","اولياء مندوبين");
define("LANGPROFP18","تلميذ مندوب");
define("LANGPROFP19"," هاتف."); // pour الهاتف
define("LANGPROFP20","العنوان الإكتروني");
define("LANGPROFP21","استكمال المعلومات الطبية  عن التلميذ");

define("LANGETUDE1","إدارة المراجعات");
define("LANGETUDE2","تعيين التلاميذ إلى المراجعة");
define("LANGETUDE3","تصفح  قائمة المراجعات المعينة");
define("LANGETUDE4","اضف مراجعة");
define("LANGETUDE5","تغيير مراجعة");
define("LANGETUDE6","إحذف مراجعة");
define("LANGETUDE7","مشاهدة مراجعة");
define("LANGETUDE8","تكليف التلميذ في مراجعة");
define("LANGETUDE9","تغيير تلميذ في مراجعة");
define("LANGETUDE10","حذف  تلميذ من مراجعة");
define("LANGETUDE11","قائمة المراجعات");


define("LANGETUDE12","قيم");
define("LANGETUDE13","مراجعة");
define("LANGETUDE14"," قاعة في");
define("LANGETUDE15","الأسبوع");
define("LANGETUDE16","في");  		// في indique une تاريخ
define("LANGETUDE17","إلى");  		// إلى indique une ساعة
define("LANGETUDE18","أثناء");  	//indique une المدة
define("LANGETUDE19","انجاز مراجعة");
define("LANGETUDE20","إسم  المراجعة");
define("LANGETUDE21","يوم  من الأسبوع");
define("LANGETUDE22","ساعة مراجعة");
define("LANGETUDE23","المدة من المراجعة");
define("LANGETUDE24","hh:mm");
define("LANGETUDE25","قاعة d'مراجعة");
define("LANGETUDE26","قيم  هذه مراجعة");
define("LANGETUDE27","المراجعة  المسجلة");
define("LANGETUDE28","قائمة المراجعات");
define("LANGETUDE29","تغيير مراجعة");
define("LANGETUDE30","هذه المراجعة تمتلك تلاميذ. إزالة  قائمة التلاميذ من  المراجعة قبل أن حذف المراجعة");
define("LANGETUDE31","قائمة التلميذ");
define("LANGETUDE32","قائمة التلاميذ");
define("LANGETUDE33","تعيين  التلميذ للمراجعة");
define("LANGETUDE34","اختيار  المراجعة");
define("LANGETUDE35","بين  الأقسام  لتعيين التلاميذ إلى هذه مراجعة");
define("LANGETUDE36","عنوان المراجعة");
define("LANGETUDE37","بين التلاميذ في هذه المراجعة");
define("LANGETUDE38","يسمح له بالخروج");
define("LANGETUDE39","سجل المراجعة");
define("LANGETUDE40","أخرى مراجعة");
define("LANGETUDE41","تغيير المراجعة  لتلميذ");
define("LANGETUDE42","تلميذ في مراجعة");
define("LANGETUDE43","سجل  التغييرات");
define("LANGETUDE44","الخروج مسموح");
define("LANGETUDE45","إحذف المراجعة  لتلميذ");

define("LANGLIST1","عرض  قسم");
define("LANGLIST2"," قائمة اساتذةقسم");
define("LANGLIST3","أستاذ عام");
define("LANGLIST4","تاريخ");
define("LANGLIST5","القائمة كاملة فـي PDF");
define("LANGLIST6","الأستاذ الرئيسي");


define("LANGPASS1"," كلمة سر جديدة");

define("LANGTRONBI1","مشاهدة الصور");
define("LANGTRONBI2","تغيير الصور");
define("LANGTRONBI3","تحذير شكل ملف غير مطابق");
define("LANGTRONBI4","غير ممكن  حجم الصورة غير مطابق");
define("LANGTRONBI5","إسم التلميذ");
define("LANGTRONBI6","الإسم التلميذ");
define("LANGTRONBI7","الصورة");
define("LANGTRONBI8","اضف صورة");


define("LANGBASE19","الملف المختار غير مصادق");
define("LANGBASE20","تلميذ بدون قسم");
define("LANGBASE21","عدد التلاميذ بدون قسم");
define("LANGBASE22","كشف  30 الأولين");
define("LANGBASE23","تغيير  قسم  للتلاميذ");
define("LANGBASE24","تغيير انتهاء");
define("LANGBASE25","قبل كل  تغيير تصفح وحدة المساعدة");
define("LANGBASE26","تغيير  قسم  للتلاميذ في القسم");
define("LANGBASE27","معلومات حول  تغيير  قسم  تلميذ");
define("LANGBASE28","<b>لا تغيير.</b> <i>(مع الخيار 'إختيار ...')</i>");
define("LANGBASE29","لم يقع أي فسخ لمعلومات  التلميذ .");
define("LANGBASE30","<b> تغيير  قسم.</b> <i>(مع إشارة  قسم)</i>");
define("LANGBASE31","فسخ الأعداد, الغيابات, التأخيرات, الإنضباط, الإعفاءات  للتلميذ.");
define("LANGBASE32","<b>الخروج من المدرسة</b>  <i>(مع اختيار 'الخروج من المدرسة')</i>");
define("LANGBASE33","فسخ التلميذ من القاعدة.");
define("LANGBASE34","فسخ الأعداد, الغيابات, التأخيرات, الإنضباط, الإعفاءات  للتلميذ.");
define("LANGBASE35","فسخ رسائل الداخلية للعائلة.");
define("LANGBASE36","يذهب  إلى قسم ");
define("LANGBASE37","الخروج من المدرسة");
define("LANGBASE38","ابعث  التغييرات");
define("LANGBASE39","اختر عنصر");


define("LANGBASE40","اختيار الثلاثي");


// MODULE AGENDA 
define("LANGAGENDA1","تحذير!!!\nتحذير! نلاحظ أن تكوينكم  أو تغيير عدد يتزامن مع عدد أخرى للمستخدمين التالية");
define("LANGAGENDA2","هل تريد حذف العدد الذي عيين لك");
define("LANGAGENDA3","فسخ عدد, تذكير :\\n\\n - جميع الحوادث الناشئة عن هذه المذكرة سيتم أيضا حذف\\n - لحذف واحدة فقط الحدوث ، انقر على الصورة للحق في المذكرة في تخطيط\\n\\nهل تريد حذف هذه المذكرة؟");
define("LANGAGENDA4","فسخ  حالة, تذكير :\\n\\n - إلا أن هذا الحدث سوف يتم إزالتها\\n - لحذف علما بكل ما فيها من الحوادث المتكررة ، انقر على الصليب للحق من المذكرة في جداول أو تحرير مذكرة وفوق [حذف]\\n\\nتريد إزالة هذا النمط؟");
define("LANGAGENDA5","عدد مع تذكير");
define("LANGAGENDA6","إحذف حدثا");
define("LANGAGENDA7","إحذف  عدد");
define("LANGAGENDA8","الاستيلاء على عدد");
define("LANGAGENDA9","اعرض  التفاصيل");
define("LANGAGENDA10","عدد شخصي");
define("LANGAGENDA11","عدد معين");
define("LANGAGENDA12","عدد ناشط");
define("LANGAGENDA13","انتهاء عدد ");
define("LANGAGENDA14","يوم عادي");
define("LANGAGENDA15","يوم عطلة");
define("LANGAGENDA16","تكوين عدد");
define("LANGAGENDA17","انقر للتغيير");
define("LANGAGENDA18","سجل  تاريخ عيد ميلاد");
define("LANGAGENDA19","تغيير  تاريخ عيد ميلاد");
define("LANGAGENDA20","من فضلك اكتب  إسم الشخص");
define("LANGAGENDA21","من فضلك اكتب  تاريخ ميلاد الشخص");
define("LANGAGENDA22","عيد ميلاد من");
define("LANGAGENDA23","تاريخ الولادة");
define("LANGAGENDA24","شكل jj/mm/aaaa");
define("LANGAGENDA25","إحذف هذا عيد الميلاد ?");
define("LANGAGENDA26","إحذف");
define("LANGAGENDA27","إلغاء");
define("LANGAGENDA28","سجل");
define("LANGAGENDA29"," عيد الميلاد هل أنت متأكد من فسخ هذا  ?");
define("LANGAGENDA30","تغيير");
define("LANGAGENDA31","السنة السابقة.");
define("LANGAGENDA32","الشهر السابق.");
define("LANGAGENDA33","التوصل اليومية تاريخ");
define("LANGAGENDA34","يحافظ للإحة ");
define("LANGAGENDA35","الشهر القادم.");
define("LANGAGENDA36","السنة القادمة.");
define("LANGAGENDA37","حدد  تاريخ");
define("LANGAGENDA38","انتقل");
define("LANGAGENDA39","اليوم");
define("LANGAGENDA40","حول الرزنامة");
define("LANGAGENDA41","اعرض %s  الأول");
define("LANGAGENDA42","اغلق");
define("LANGAGENDA43","انقر أو اسحب لتغيير القيمة");
define("LANGAGENDA44","مستخدم مجهول");
define("LANGAGENDA45","دورتكم قد انتهت صلاحيتها!");
define("LANGAGENDA46","هذا الدخول قد استخدم بالفعل");
define("LANGAGENDA47","كلمة السر السابقة خاطئة");
define("LANGAGENDA48","من فضلك  التوقيع في استخدام Phenix");
define("LANGAGENDA49","الصدد إلى فشل الخادم  SQL ");
define("LANGAGENDA50","مظهر جانبي متغيير");
define("LANGAGENDA51","عدد مسجل");
define("LANGAGENDA52","عدد تحديث");
define("LANGAGENDA53","عدد فسخ");
define("LANGAGENDA54","وقوع عدد فسخ");
define("LANGAGENDA55","عيد ميلاد مسجل");
define("LANGAGENDA56","عيد ميلاد تحديث");
define("LANGAGENDA57","عيد ميلاد ازيل");
define("LANGAGENDA58","الحساب متكون ، يمكنك الاتصال");
define("LANGAGENDA59","التسجيل  فشل");
define("LANGAGENDA60","كل الميادين");
define("LANGAGENDA61","شركة");
define("LANGAGENDA62","إسم + الفترةإسم");
define("LANGAGENDA63","العنوان");
define("LANGAGENDA64","رقم الهاتف");
define("LANGAGENDA65","العنوان العنوان الإكتروني");
define("LANGAGENDA66","ملاحظات");
define("LANGAGENDA67","إبدأ البحث");
define("LANGAGENDA68","شركة");
define("LANGAGENDA69","إسم");
define("LANGAGENDA70","الإسم");
define("LANGAGENDA71","العنوان");
define("LANGAGENDA72","البلدة");
define("LANGAGENDA73","البلد");
define("LANGAGENDA74","هاتف المنزل");
define("LANGAGENDA75","هاتف المهنة");
define("LANGAGENDA76","الهاتف الجوال");
define("LANGAGENDA77","فاكس");
define("LANGAGENDA78","العنوان الإكتروني");
define("LANGAGENDA79","العنوان الإكتروني Pro");
define("LANGAGENDA80","عدد / متفرقات");
define("LANGAGENDA81","مجموعة");
define("LANGAGENDA82","تقاسم");
define("LANGAGENDA83","CP");
define("LANGAGENDA84","تاريخ الولادة");
define("LANGAGENDA85","كرر من جديد");
define("LANGAGENDA86","استيراد ");
define("LANGAGENDA87","التوريد انتهى");
define("LANGAGENDA88","أضيف الإتصال");
define("LANGAGENDA89","لا يوجد اتصال متوفرة!");
define("LANGAGENDA90","<LI>في Outlook ، وجعل <I>ملف</I>-&gt;<I>صدر</I>-&gt;<I>أخرى دفتر العنوان...</I></LI>");
define("LANGAGENDA91","<LI>اختيار <I>مذكرة نص (قيم مفصولة بفواصل)</I> ثم <I>صدر</I></LI>");
define("LANGAGENDA92","<LI>اختيار الملف الذي سيتم حفظه ثم <I>التالي</I></LI>");
define("LANGAGENDA93","<LI>في قائمة  الميادين للتصدير ، اختر :<BR>");
define("LANGAGENDA94","<I>الفترةإسم ، إسم ، العنوان رسالة نهج (المنزل) البلدة (المنزل) الرقم البريدي (المنزل) البلد / المنطقة (المنزل) ، هاتف المنزل ، الهواتف النقالة ، والتلفزيون المهنية الهاتف والفاكس شركة مهنية</I> ثم انقر فوق <I>انتهاء</I></LI>");
define("LANGAGENDA95","<LI>الحصول على الملف الذي تم إنشاؤه في النموذج أدناه وانقر على <I>استيراد </I></LI>");
define("LANGAGENDA96","من فضلك ادخل على الشركة من أجل البحث");
define("LANGAGENDA97","من فضلك ادخل إسم أو لقب للبحث");
define("LANGAGENDA98","من فضلك ادخل عنوان من أجل البحث");
define("LANGAGENDA99","من فضلك ادخل رقم  الهاتف  من أجل البحث");
define("LANGAGENDA100","من فضلك ادخل العنوان الإلكتروني إلى البحث");
define("LANGAGENDA101","من فضلك اكتب والخردة من التعليقات عن البحث");
define("LANGAGENDA102","من فضلك ادخل  معيار واحد على الأقل من أجل البحث");
define("LANGAGENDA103","هل أنت متأكد من أنك تريد حذف هذا الاتصال؟");
define("LANGAGENDA104","سنة");
define("LANGAGENDA105","لا أب");
define("LANGAGENDA106","قائمة الأشخاص<BR> الذين يمكنك<BR> تعيين عدد");
define("LANGAGENDA107","أحد يستطيع أن");
define("LANGAGENDA108","الشخص المختار");
define("LANGAGENDA109","تدقيق العرض");
define("LANGAGENDA110","شريحة من 30دقيقة");
define("LANGAGENDA111","شريحة من 15دقيقة");
define("LANGAGENDA112","ساعة البدء");
define("LANGAGENDA113","الساعة  نهاية");
define("LANGAGENDA114","مشغول");
define("LANGAGENDA115","جزئي");
define("LANGAGENDA116","حرا");
define("LANGAGENDA117","تكوين عدد ادخل ");
define("LANGAGENDA118","التفاصيل من قبل مستخدم لهذا اليوم");
define("LANGAGENDA119","اعرض");
define("LANGAGENDA120","من فضلك حدد شخص");
define("LANGAGENDA121","يرجى تحديد وقت انتهاء بعد وقت البدء");
define("LANGAGENDA122","الأسبوع من ");
define("LANGAGENDA123","إلى");
define("LANGAGENDA124","الأسبوع الموالي");
define("LANGAGENDA125","إحذف");
define("LANGAGENDA126","توافر  إتصالاتك  ل");
define("LANGAGENDA127","اضف");
define("LANGAGENDA128","خارج الملف الشخصي");
define("LANGAGENDA129","يرجى تحديد وقت انتهاء بعد وقت البدء");
define("LANGAGENDA130","تدقيق العرض");
define("LANGAGENDA131","من فضلك اكتب إسم");
define("LANGAGENDA132","من فضلك اكتب عنوان صفحة");
define("LANGAGENDA133","اضف  مفضل");
define("LANGAGENDA134","الطباعة في وضع أفقي أوصت");
define("LANGAGENDA135","الأسبوع السابق ");
define("LANGAGENDA136","الأسبوع ");
define("LANGAGENDA137","من");
define("LANGAGENDA138","عيد ميلاد");
define("LANGAGENDA139","تذكير الافتراضي إلى انشاء عدد");
define("LANGAGENDA140","لا تذكير");
define("LANGAGENDA141","تذكير");
define("LANGAGENDA142","نسخة بالبريد");
define("LANGAGENDA143","دقيقة");
define("LANGAGENDA144","ساعة");
define("LANGAGENDA145","أيام");
define("LANGAGENDA146","يوم نموذجي");
define("LANGAGENDA147","ينتهي في");
define("LANGAGENDA148","الهاتف VF");
define("LANGAGENDA149","واجهة");
define("LANGAGENDA150","تنظيم الافتراضي");
define("LANGAGENDA151","يومي");
define("LANGAGENDA152","الأسبوعية");
define("LANGAGENDA153","شهري");
define("LANGAGENDA154","30 دقائق");
define("LANGAGENDA155","15 دقائق");
define("LANGAGENDA156","45 دقائق");
define("LANGAGENDA157","1 ساعة");
define("LANGAGENDA158","اختيار تلقائي  لنهاية وقت العدد");
define("LANGAGENDA159","تقاسم التخطيط بالتشاور");
define("LANGAGENDA160","الأشخاص المخولين إلى تصفح  جدولي الزمني");
define("LANGAGENDA161","لا مشتركة");
define("LANGAGENDA162","للاختيار");
define("LANGAGENDA163","كل الأشخاص");
define("LANGAGENDA164","تقاسم التخطيط <BR>في تغيير ");
define("LANGAGENDA165","شخص قادر على اسنادي عدد");
define("LANGAGENDA166","يقع إعلامي بالبريد الإلكتروني عندما يسند لي عدد");
define("LANGAGENDA167","إحذف العدد هذا الذي وضعته");
define("LANGAGENDA168","إحذف   العدد هذا الذي خصص لي");
define("LANGAGENDA169","تخصيص   العدد هذا الذي اسند إليا");
define("LANGAGENDA170","كامل اليوم");
define("LANGAGENDA171","اختيار  الصياغة");
define("LANGAGENDA172","الصياغة الجديدة ");
define("LANGAGENDA173","العنوان");
define("LANGAGENDA174","معدل الفترة");
define("LANGAGENDA175","لون");
define("LANGAGENDA176","ظهور العدد");
define("LANGAGENDA177","إحذف هذه التسمية؟");
define("LANGAGENDA178","سجل مذكرة ");
define("LANGAGENDA179","من فضلك اكتب  عنوان");
define("LANGAGENDA180","عنوان");
define("LANGAGENDA181","محتوى");
define("LANGAGENDA182","هل أنت متأكد من أنك تريد حذف هذه المذكرة؟");
define("LANGAGENDA183","سجل  عدد");
define("LANGAGENDA184","العدد الذي تريد تغييره ينتمي إلى سلسلة متكررة");
define("LANGAGENDA185","هل تريد تغيير سلسلة كاملة أو مجرد الحالة هذا؟");
define("LANGAGENDA186","السلسلة كاملة ");
define("LANGAGENDA187","فقط هذه الحالة");
define("LANGAGENDA188","عدد يغطي كامل يوم");
define("LANGAGENDA189","اعرض في رزنامة");
define("LANGAGENDA190","كامل اليوم");
define("LANGAGENDA191","يبدأ");  // بداية إلى
define("LANGAGENDA192","الشخص <BR>المعني");
define("LANGAGENDA193","ظهور العدد");
define("LANGAGENDA194","عدد للعموم");
define("LANGAGENDA195","عدد مفصل في تقاسم التخطيط");
define("LANGAGENDA196","إشارة \"مشغول \" في تقاسم التخطيط");
define("LANGAGENDA197","عدد خاص");
define("LANGAGENDA198","مشغول ");
define("LANGAGENDA199","يعتبر كغير شاغر<B> في  وحدة<B> الشغور");
define("LANGAGENDA200","حرا");
define("LANGAGENDA201","يعتبر<B> كحر <B>في وحدة الشغور");
define("LANGAGENDA202","لون");
define("LANGAGENDA203","تقاسم");
define("LANGAGENDA204","شغور");
define("LANGAGENDA205","تذكير");
define("LANGAGENDA206","لا تذكير");
define("LANGAGENDA207","نسخة بالبريد");
define("LANGAGENDA208","مقدما");  // إلى l'avance
define("LANGAGENDA209","تردد");
define("LANGAGENDA210","أي");
define("LANGAGENDA211","يوميا");
define("LANGAGENDA212","أسبوعيا");
define("LANGAGENDA213","شهريا");
define("LANGAGENDA214","سنويا");
define("LANGAGENDA215","كل ");
define("LANGAGENDA215bis","أيام");
define("LANGAGENDA216","كل أيام العمل (الإثنين إلي الجمعة)");
define("LANGAGENDA217","كل أيام اسبوعي النوعي");
define("LANGAGENDA218","المعلومات  المضبوطة أو معدلة لن تسجل\\nهل أنت متأكد أنك تريد المتابعة؟");
define("LANGAGENDA219","مظهر");
define("LANGAGENDA220","كل ");
define("LANGAGENDA221","كل ");
define("LANGAGENDA221bis","أسابيع");
define("LANGAGENDA222","من كل شهر");
define("LANGAGENDA223","الأول");
define("LANGAGENDA224","الثاني");
define("LANGAGENDA225","الثالث");
define("LANGAGENDA226","الرابع");
define("LANGAGENDA227","الأخير");
define("LANGAGENDA228","في الشهر");
define("LANGAGENDA229","في ");
define("LANGAGENDA230","بين  تاريخ  النهاية");
define("LANGAGENDA231","بعد نهاية"); // نهاية après
define("LANGAGENDA232","نهاية في");
define("LANGAGENDA233","حالة");
define("LANGAGENDA234","من فضلك اكتب الصياغة");
define("LANGAGENDA235","من فضلك اكتب  تاريخ");
define("LANGAGENDA236","من فضلك حدد  الساعة  نهاية\\nبعد وقت البدء");  // \\n signifie un retour chariot
define("LANGAGENDA237","من فضلك حدد شخص");
define("LANGAGENDA238","من فضلك اكتب  عدد  الأيام\\nأكبر من أو يساوي 1");
define("LANGAGENDA239","من فضلك اكتب  عدد الحالة\\nأكبر من أو يساوي 1");
define("LANGAGENDA240","تكرار"); // répétition
define("LANGAGENDA241","الرجاء إدخال اسمك والقب في الأول");
define("LANGAGENDA242","من فضلك اكتب  إسمك");
define("LANGAGENDA243","يجب كتابة اسم الدخول");
define("LANGAGENDA244","من فضلك اكتب  السر كلمة القديمة");
define("LANGAGENDA245","كلمة السر مختلفة ");
define("LANGAGENDA246"," كلمة السر اجبارية");
define("LANGAGENDA247","من فضلك حدد  الساعة  نهاية\\nبعد وقت البدء");
define("LANGAGENDA248","إحذف هذه حالة");
define("LANGAGENDA249","عدد العودية");
define("LANGAGENDA250","إحذف   العدد هذا الذي وضعته");
define("LANGAGENDA251","تخصيص   العدد هذا الذي اسند إليا");
define("LANGAGENDA252","تصفية");
define("LANGAGENDA253","اطبع هذا التخطيط");
define("LANGAGENDA254","الطباعة في وضع أفقي أوصت");
define("LANGAGENDA255","عدد كون من طرف ");
define("LANGAGENDA256","غيير النظام الأساسي");
define("LANGAGENDA257","إحذف هذه حالة");
define("LANGAGENDA258","إحذف   العدد هذا الذي وضعته");
define("LANGAGENDA259","إحذف   العدد هذا الذي خصص لي");
define("LANGAGENDA260"," عدد");
define("LANGAGENDA261","عيد ميلاد");
define("LANGAGENDA262","جهة اتصال");
define("LANGAGENDA263"," للمستخدم اختيار أدناه");
define("LANGAGENDA264","اضف  عدد");
define("LANGAGENDA265","البحث");
define("LANGAGENDA266","توافر");
define("LANGAGENDA267","اتصالات");
define("LANGAGENDA268","مذكرة");
define("LANGAGENDA269","الصياغة");
define("LANGAGENDA270","مفضل");
define("LANGAGENDA271","مظهر جانبي");
define("LANGAGENDA272","فشل انجاز التصدير");
define("LANGAGENDA273","جدول أعمال ");
// FIN AGENDA

define("LANGL","إ");  // L من lundi
define("LANGM","ث");  // M من mardi
define("LANGME","إ");  // M من mercredi
define("LANGJ","خ");  // J من jeudi
define("LANGV","ج");  // V من vendredi
define("LANGS","س");  // S من samedi
define("LANGD","أ");  // D من dimanche

define("LANGL1","إثن"); // Jours sur 3 lettres
define("LANGM1","ثلث");	// Jours sur 3 lettres
define("LANGME1","إرع"); // Jours sur 3 lettres
define("LANGJ1","خمس");	// Jours sur 3 lettres
define("LANGV1","جمع");	// Jours sur 3 lettres
define("LANGS1","سبت");	// Jours sur 3 lettres
define("LANGD1","أحد");	// Jours sur 3 lettres

define("LANGMOIS21","جانفي");			// mois abregé
define("LANGMOIS22","فيفري"); 		// mois abregé
define("LANGMOIS23","مارس");			// mois abregé
define("LANGMOIS24","أفريل");				// mois abregé
define("LANGMOIS25","ماي");				// mois abregé
define("LANGMOIS26","جوان");			// mois abregé
define("LANGMOIS27","جويلية");			// mois abregé
define("LANGMOIS28","أوت");		// mois abregé
define("LANGMOIS29","سبتمبر");			// mois abregé
define("LANGMOIS210","أكتوبر");			// mois abregé
define("LANGMOIS211","نوفمبر"); 			// mois abregé
define("LANGMOIS212","ديسمبر"); 	// mois abregé



define("LANGPROFP22","هذا المدرس تم بالفعل تعيينه كأستاذ عام. \\n\\n فريق ترياد");



define("LANGSTAGE23","إسم النشاط");
define("LANGSTAGE24","تسجيل شركة جديدة");
define("LANGSTAGE25","اسم هذه الشركة هو مسجل بالفعل");
define("LANGSTAGE26","إسم الشركة");
define("LANGSTAGE27","للإتصال");
define("LANGSTAGE28","العنوان");
define("LANGSTAGE29","الرقم البريدي");
define("LANGSTAGE30","البلدة");
define("LANGSTAGE31","قطاع النشاط");
define("LANGSTAGE32","اضف نشاط");
define("LANGSTAGE33","النشاط الرئيسي");
define("LANGSTAGE34","الهاتف");
define("LANGSTAGE35","فاكس");
define("LANGSTAGE36","العنوان الإكتروني");
define("LANGSTAGE37","معلومات");
define("LANGSTAGE38","إستشارة المؤسسات");
define("LANGSTAGE39","شركة");
define("LANGSTAGE40","النشاط الرئيسي");
define("LANGSTAGE41","أخرى بحث");
define("LANGSTAGE42"," هاتف. / فاكس");
define("LANGSTAGE43","لا توجد أي شركة بهذا الاسم");
define("LANGSTAGE44","جدولة  تربصات");
define("LANGSTAGE45","تاريخ  بداية التربص");
define("LANGSTAGE46","تاريخ  نهاية التربص");
define("LANGSTAGE47","سجل في تربص");
define("LANGSTAGE48","رقم  التربص");
define("LANGSTAGE49","تغيير تاريخ  التربصات");
define("LANGSTAGE50","تربص");
define("LANGSTAGE51","تاريخ  التربص");
define("LANGSTAGE52","خطأ في الإدخال");
define("LANGSTAGE53","تحديث التربص");
define("LANGSTAGE54","في تربص  ");
define("LANGSTAGE55"," أقسام ");
define("LANGSTAGE56"," مسجلة");
define("LANGSTAGE57","تاريخ التربص, حذف \\n\\n فريق ترياد");
define("LANGSTAGE58","مؤسسة المسجلة \\n\\n فريق ترياد");
define("LANGSTAGE59","تغيير شركة");
define("LANGSTAGE60","تصفح  المؤسسات حسب نشاطها");
define("LANGSTAGE61","البحث عن مؤسسات");
define("LANGSTAGE62","معلومات");
define("LANGSTAGE63","قائمة كاملة");
define("LANGSTAGE64","مشاهدة تواريخ التربص");
define("LANGSTAGE65","فسخ شركة");
define("LANGSTAGE66","مؤسسة حذفت \\n\\n فريق ترياد");
define("LANGSTAGE67","تصفح  المؤسسات حسب نشاطها");
define("LANGSTAGE68","لا توجد أي شركة بهذا الاسم");
define("LANGSTAGE69","مشاهدة  تلميذ إلى  تربص");
define("LANGSTAGE70","اطبع في تربص رقم");
define("LANGSTAGE71","مشاهدة  التلميذ إلى تربصات");
define("LANGSTAGE72","&nbsp;تاريخ&nbsp;من&nbsp;تربص&nbsp;"); // المسؤولecter les &nbsp;
define("LANGSTAGE73","عودة");
define("LANGSTAGE74","مؤسسة");
define("LANGSTAGE75","تعيين  تلميذ في  تربص");
define("LANGSTAGE76","مكان  التربص");
define("LANGSTAGE77","المسؤول");
define("LANGSTAGE78","مدرس زائر");
define("LANGSTAGE79","ساكن");
define("LANGSTAGE80","متغذى");
define("LANGSTAGE81","مرور في عدة خدمات");
define("LANGSTAGE82"," الخدمة سبب تغيير");
define("LANGSTAGE83","معلومات. إضافية");
define("LANGSTAGE84","انجاز المسجلة \\n \\n فريق ترياد");
define("LANGSTAGE85","تاريخ الزيارة");
define("LANGSTAGE86","تغيير  تلميذ في  تربص");
define("LANGSTAGE87","معلومات مسجلة");
define("LANGSTAGE88","فسخ  تلميذ من  تربص");


define("LANGRESA62","اسم");
define("LANGRESA63","مرفوض");
define("LANGRESA64","اضف طلب");
define("LANGRESA65","&nbsp;De&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;إلى");
define("LANGRESA66","محجوز");
define("LANGRESA66bis","من طرف");  // suite réservé par
define("LANGRESA67","غير مؤكدة");
define("LANGRESA68","تأكيد");
define("LANGRESA69","انتهاء التسجيل");
define("LANGRESA70"," لأجل حجز");






define("LANGNOTEUSA1","تكوين مخصصات الأعداد في وضع  USA");
define("LANGNOTEUSA2","هذا النموذج يسمح لك لوضع حروف إلى النسبة المئوية المخصصة لكل عدد (حروف).");
define("LANGNOTEUSA3","على سبيل المثال : 95 إلى 100 --> ألف + ، 87 إلى 94 --> أليف ، الخ...");
define("LANGNOTEUSA4","  مـن");
define("LANGNOTEUSA4bis","إلى");
define("LANGNOTEUSA4ter","يساوي");   //  ex : De  10 إلى 20 يساوي B
define("LANGNOTEUSA5","ادخل العدد");
define("LANGNOTEUSA5bis","مع  عدد");
define("LANGNOTEUSA5ter","هذا يساوي");



define("LANGABS56","قائمة من الغيابات بدون مبرر");
define("LANGABS57","أجريت لتحديث هذه القائمة من التلاميذ");




define("LANGSANC1","عقوبة مكونةe -- فريق ترياد");
define("LANGSANC2","الفئة لا حذف. هذه الفئة هي بالفعل تم تعيينها لعقوبة أو التلميذ --  فريق ترياد");
define("LANGSANC3","تكوين الانضباط");
define("LANGSANC4","تسجيل الفئات.");
define("LANGSANC5","عنوان الفئة");
define("LANGSANC6","تسجيل أسماء العقوبات حسب الفئة.");
define("LANGSANC7","عنوان عقوبة");
define("LANGSANC8","تكوين الإحتفاظ ");
define("LANGSANC9","رسالة تحذير عندما يكون التلميذ قد وصل إلى الحد.");
define("LANGSANC10","لفئة");
define("LANGSANC11","رسالة التحذير بعد");
define("LANGSANC12","عدة مرات");
define("LANGSANC13","مكونة من طرف");
define("LANGSANC14","تاريخ الإدخال");

// تغيير من ces 2 phrases إلى traduire
// define("LANGPARAM1","<font class=T1>Composez votre texte لأجلcontenu du رسالة من l'غياب pour l'envoi du courrier aux parents d'التلميذ. Pour une prise en compte du إسم مع du إسم من l'التلميذ automatiquement dans chaque document, من فضلك présiser la chaîne <b>إسمEleve</b> مع <b>PreإسمEleve</b> إلى l'emplacement désiré. De même possibilité d'بين القسم مع في mot clef <b>القسمEleve</b>, ou la تاريخ من l'غياب ABSDEBUT ou ABSFIN ainsi que la المدة ABSفترة </font><br><br>");
// define("LANGPARAM2","<font class=T1>Composez votre texte لأجلcontenu du رسالة من تأخير pour l'envoi du courrier aux parents. Pour une prise en compte du إسم مع du إسم من l'التلميذ automatiquement dans chaque document, من فضلك présiser la chaîne <b>إسمEleve</b> مع <b>PreإسمEleve</b> إلى l'emplacement désiré. De même possibilité d'بين القسم مع في mot clef <b>القسمEleve</b>, ou la تاريخ du تأخير RTDتاريخ , l'ساعة RTDساعة ainsi que في المدة RTDفترة </font><br><br>");


define("LANGMODIF4","تحوير العضو");
define("LANGMODIF5","معلومات عن الإتصال");
define("LANGMODIF6","صورة للتعريف");
define("LANGMODIF7","معلومات عن العضو");
define("LANGMODIF8","العنوان");
define("LANGMODIF9","الرقم البريدي");
define("LANGMODIF10","البلدة");
define("LANGMODIF11"," هاتف.");
define("LANGMODIF12","العنوان الإكتروني");
define("LANGMODIF13","تحوير العضو");
define("LANGMODIF14","حساب معدل --  فريق ترياد");
define("LANGMODIF15"," ل كلمة السر  ");
define("LANGMODIF15bis"," وقع تعديلها.");
define("LANGMODIF16"," تغيير كلمة السر");
define("LANGMODIF17","غير ممكن  حجم الصورة غير مطابق");
define("LANGMODIF18","تحديث هذه صورة");
define("LANGMODIF19","اضف  صورة");
define("LANGMODIF20","تغيير  صورة");

define("LANGGRP25bis","إدارة مجموعات");
define("LANGGRP26","قائمة مجموعات");
define("LANGGRP27","اضف  تلميذ في مجموعة");
define("LANGGRP28","إحذف  تلميذ من مجموعة");
define("LANGGRP29","إسم  المجموعة");
define("LANGGRP30","الأقسام المعنية");
define("LANGGRP31","تغيير قائمة");
define("LANGGRP32","اضف تلاميذ  في المجموعة");
define("LANGGRP33","اضف  تلميذ في هذه المجموعة");
define("LANGGRP34","تلميذ  في قسم  ");
define("LANGGRP35","تلميذ  في المجموعة");
define("LANGGRP36","ابعث في مجموعة");
define("LANGGRP37","مجموعة معدلة --  فريق ترياد ");
define("LANGGRP38","قائمة تلاميذ  المجموعة ");
define("LANGGRP39","لا يوجد أي التلميذ في هذه المجموعة");

define("LANGCARNET1","دفتر  الأعداد");
define("LANGCARNET2","قسم التلميذ");
define("LANGCARNET3","انقر على<b>إسم</b> التلميذ");

define("LANGPASSG1","كلمة السر  يجب أن تكون <b>8 حروف</b> الحد الأدن,<br /> <b>رقمي وحرفي</b> مع استعمال <b>الحروف الكبيرة و الصغيرة</b>.");
define("LANGPASSG2","كلمة السر  غير صحيحة. \\n كلمة السر  يجب أن تشمل ما يلي :\\n\\n -> 8 حروف الحد الأدن, \\n -> رقمي وحرفي, \\n -> الحروف الكبيرة و الصغيرة \\n\\n L\\' فريق ترياد");
define("LANGPASSG3","فشل انشاء");



define("LANGDISC38","اضف عقوبة");
define("LANGDISC39","إدارة الإنضباط");
define("LANGDISC40","الإحتفاظ لم يقع.");
define("LANGDISC41","تنظيم الإحتفاظ.");
define("LANGDISC42","الإحتفاظ لم يعهد به  تلميذ.");
define("LANGDISC43","تكوين.");
define("LANGDISC44","إحذف الإحتفاظ مع عقوبات");
define("LANGDISC45","إحذف الإحتفاظ مع عقوبات");
define("LANGDISC46","قائمة  الغيابات و  التأخيرات  لقسم");
define("LANGDISC47","بين  فترة البداية   ");
define("LANGDISC48","بين  فترة النهاية  ");
define("LANGDISC49","بين  الشعبة");
define("LANGDISC50","<br><ul>فسخ  الإحتفاظ و  العقوبات في <br>وظيفة فاصل التاريخ </ul>");
define("LANGDISC51","كل الأقسام");
define("LANGDISC52","الإحتفاظ و العقوبات إزيلت");
define("LANGDISC53","خطأ! الإحتفاظ و العقوبات لم تفسخ");

define("LANGIMP53","مذكرةASCII via SQL ");


// autre new

define("LANGSTAGE31bis","2 قطاع النشاط");
define("LANGSTAGE31ter","3 قطاع النشاط");
define("LANGMEDIC1","الملف الطبي للتلميذ");
define("LANGMEDIC2","ابعث البحث");
define("LANGMEDIC3","معلومات / تغيير");


define("LANGDISC54","معاينة التخصصات التلميذ");
define("LANGDISC55","إحذف عقوبة");
define("LANGDISC56","إحذف عقوبة");

define("LANGBASE6bis","إجمالي عدد التلاميذ في الملف ");

define("LANGMODIF21","كلمة السر يجب أن يكون :\\n\\n -- الحد الأدنى من 8 أحرف \ \ ن -- حروف وأرقام \ \ ن -- الكبيرة والصغيرة.\\n\\n  فريق ترياد");

define("LANGMODIF22","كلمة السر : 8 حروف -- حروف وأرقام -- الكبيرة والصغيرة");
define("LANGPASS1bis","تأكيد كلمة السر");

define("LANGMODIF23","يمكنك تغيير  كلمة السر لحسابك ترياد");
define("LANGMODIF24","العضو ");
define("LANGMODIF24bis","بصدد المصادقة..");
define("LANGMODIF24ter","الآن جاهز");
define("LANGMODIF25","كلمة السر غير متطابقة. \\n\\n  فريق ترياد");

define("LANGABS58","مشاهدة / فسخ  غياب - تأخير");
define("LANGABS59","كشف كامل  التأخيرات");
define("LANGABS60","أثناء");  	// une المدة أثناء tant من temps
define("LANGABS61","مشاهدة / تغيير   غياب - تأخير");
define("LANGABS62","كشف <b>كامل</B> الغيابات  التأخيرات و");
define("LANGABS63","مصادرة في");
define("LANGABS64","كشف  <b>5</B> اخر غياب و تأخير");
define("LANGABS65","كشف كامل  للغيابات");
define("LANGABS66","  وقع تحديث هذه القائمة من التلاميذ");
define("LANGABS6bis","قائمة  التأخيرات الغير مبررة");
define("LANGABS4bis","قائمة الغيابات أو التأخيرات");
define("LANGABS67","<font class=T2>لا يوجد أي تلميذ في  هذا قسم</font>");
define("LANGABS68","قائمة  الغيابات/ التأخيرات  قسم");
define("LANGABS69","تراكم  غيابات/ تأخيرات التلاميذ");
define("LANGABS70","تكوين  الأسباب");
define("LANGABS71","عدد الغيابات / تراكم");
define("LANGABS72","عدد  التأخيرات / تراكم");
define("LANGABS73","الغيابات - التأخيرات -  من القسم ");
define("LANGABS74","قم ب التحديث");
define("LANGABS75","أي غائب أو تأخير");
define("LANGABS76","كشف");

define("LANGDEPART3","بعد مشكلة فنية ،");
define("LANGDEPART4","الوصول إلى الخادم غير متوفر. فريق ترياد يعمل حاليا على الخادم.");

define("LANGBASE3_2","هنا قائمة الملفات التي يمكن استيرادها.");
define("LANGbasededoni21_2","هل تريد الإستمرار ؟ \\n\\n L\' فريق ترياد");
define("LANGbasededon21","إرسال ملف يمكن أن يدوم من <b>2 إلى 4 دقيقة</b> حسب عدد العناصر");
define("LANGbasededon31_2","بين المواد التي تريد استيرادها.");
define("LANGBASE10_2","بين  الأستاذة الذين تريد  اضافتهم.");

define("LANGBASE16_2"," الأعمدة ممثلة على النحو التالي : <b>لقب الدخول ; إسم الدخول ; كلمة السر واضحة</b>");
define("LANGIMP25_2","إسم المعهد");
// ----------------------------- //
define("LANGABS77","يذكر في");
define("LANGSTAGE89","اتفاقية إنشاء تربص");
define("LANGSTAGE90","خروج الاتفاقات التربص");
define("LANGSTAFE91","قائمة التلاميذ في شركة");
define("LANGSTAGE92","قائمة التلاميذ في شركة");
define("LANGPASSG4","كلمة السر  يجب أن تكون <b>8 حروف</b> الحد الأدن <br /><b>رقمي وحرفي</b>.");
define("LANGPASSG5","كلمة السر  يجب أن تكون <b>4 حروف</b> الحد الأدن.");
define("LANGPASSG6","كلمة السر  غير صحيحة. \\n كلمة السر  يجب أن تشمل ما يلي :\\n\\n -> 8 حروف الحد الأدن, \\n -> رقمي وحرفي \\n\\n L\\' فريق ترياد");
define("LANGPASSG7","كلمة السر  غير صحيحة. \\n كلمة السر  يجب أن تشمل ما يلي :\\n\\n -> 4 حروف الحد الأدن. \\n\\n L\\' فريق ترياد");

define("LANGMODIF22_1","كلمة السر : 4 حروف");
define("LANGMODIF22_2","كلمة السر : 8 حروف - رقمي وحرفي ");
define("LANGMODIF22_3","كلمة السر : 8 حروف -- حروف وأرقام -- الكبيرة والصغيرة");
define("LANGDEPART2","<font color=red  class=T2>حذار  للاستخدام ترياد ،  متغير  php  '<strong>register_globals</strong>' يجب أن يكون على <u>Off</u>.</font><br />");


define("LANGacce15","واجب أن يقدم في");
define("LANGacce16","واجب أن يقدم اليوم");
define("LANGacce17","إضافة عقوبة تأديبية");

define("LANGBASE41","إحذف جميع التلاميذ قبل الاستيراد");
define("LANGBASE7bis","تلميذ سبق تعيينه ");
define("LANGBASE8bis"," للتلاميذ <u>المعينين</u> مع <u>بدون قسم</u>");

define("LANGPER21bis","لغة&nbsp;/&nbsp;الخيار");

define("LANGASS6ter","تلميذ");
define("LANGASS41","تخزين");
define("LANGASS42","إعداد");

define("LANGIMP46bis","كلمة السر");

define("LANGIMP54","رقم الشارع");
define("LANGIMP55","العنوان");
define("LANGIMP56","الرمز البريدي");
define("LANGIMP57","الهاتف");
define("LANGIMP58","العنوان الإكتروني");
define("LANGIMP59","بلدة");

define("LANGBULL1pp","طباعة البطاقة الثلاثية أو نصف سنوية");
define("LANGBT43pp","اطبع الجدول ");


define("LANGMESS38"," الرسالة قُرِئَتْ");
define("LANGMESS39","رسالة لم تُقْرَأُ.");


define("LANGDISC57","السبب&nbsp;/&nbsp;عقوبة");

define("CUMUL01","تراكم  الغيابات و التأخيرات في قسم من طرف تلميذ");
define("CUMUL02","تراكم  العقوبات في قسم من طرف تلميذذ");
define("CUMUL03","تراكم  عقوبات  تلميذ");
define("LANGPROJ18bis","ساعة ");
define("LANGCREAT1","حساب موجود.");
define("ERREUR1","الانترنت لا تتوفر لهذه الوحدة.");
define("ERREUR2","تصفح في تكوين وحدة لتشغيل الشبكة.");


define("PASSG8"," تغيير كلمة السر");
define("PASSG9","  كلمة سر التلميذ ");
define("PASSG9bis"," وقع تعديلها.");


define("LANGPARAM34","موقع واب المعهد");
define("LANGLOGO3bis","الشعار <b>يجب أن يكون مهيأ في شكل jpg</b>");


define("LANGMAT1","سجل المادة");
define("LANGMAT2","قائمة / تغيير  مادة");
define("LANGMAT3","إحذف المادة");
define("LANGMAT4","ابعث التغيير");
define("LANGMAT5","المادة تغيرت");
define("LANGMAT6","المادة عيينت");
define("LANGCLAS1","قائمة / تغيير قسم");
define("LANGCLAS2","قسم تغيير");
define("LANGCLAS3","عين القسم");

define("LANGDEVOIR1","للجموعة");
define("LANGDEVOIR2","للقسم");
define("LANGDEVOIR3","سجل فرض مدرسي");
define("LANGCIRCU111","<font face=Verdana size=1><B><font color=red>ش</font></B>كل الوثيقة : <b> doc</b>, <b>pdf</b>, <b>txt</b>.</FONT>");

define("LANGAFF7","وحدة  فسخ تعيين  الأقسام.");
define("LANGAFF8","حذار إلى هذه الوحدة يتم استخدامها عند فسخ التعيين ،<br> انه يدمر كل أعداد  تلاميذ  الاقسام التي فسخت");
define("LANGAFF9","حذار ، أعداد من الأقسام المختارة سيتم حذفها. \\n هل تستمر؟ \\n\\n  فريق ترياد");
define("LANGCREAT2","حذف عضـو ");


define("LANGPROF37","كراس الواجبات ");

// news

define("LANGPARAM35","اختيار  البطاقة");
define("LANGPROBLE1","الجواب عبر البريد الإكتروني");
define("LANGPROBLE2","كل الميادين يجب تعميرها");
define("LANGMESS37","هذه الوحدة لم يتم التصديق عليها من قبل مسؤول ترياد.<br><br> فريق ترياد");

define("LANGPROFP23","الأعداد المدرسية ل ");
define("LANGPROFP24","من شهر");
define("LANGPROFP25","الصور");
define("LANGPROFP26","متابعة  تلميذ");
define("LANGPROFP27","معلومات حول المندوبين");
define("LANGPROFP28","رسالة  الأقسام");
define("LANGPROFP29","منشور  الأقسام");
define("LANGPROFP30","إدارة التربص المهني");
define("LANGPROFP31","جدول معدلات التلاميذ");
define("LANGPROFP32","بطاقات رسومات التلاميذ");


define("LANGLETTRELUNDI","إ");	  // Lundi
define("LANGLETTREMARDI","ث");    // Mardi
define("LANGLETTREMERCREDI","ر"); // Mercredi
define("LANGLETTREJEUDI","خ");    // Jeudi
define("LANGLETTREVENDREDI","ج"); // Vendredi
define("LANGLETTRESAMEDI","س");   // Samedi
define("LANGLETTREDIMANCHE","ح"); // Dimanche



define("LANGRESA71","حجز  في");
define("LANGRESA72","من");
define("LANGRESA73","إلى");
define("LANGRESA74","معلومات إضافية");

define("LANGbasededoni52","القيمة المقبولة : <b>0</b> ou السيد.<br>");
define("LANGbasededoni53","القيمة المقبولة : <b>1</b> ou السيدة<br>");
define("LANGbasededoni54","القيمة المقبولة : <b>2</b> ou الآنسة.<br>");
define("LANGbasededoni54_2","القيمة المقبولة : <b>3</b> ou أوانس <br>");
define("LANGbasededoni54_3","القيمة المقبولة : <b>4</b> ou السيد <br>");
define("LANGbasededoni54_4","القيمة المقبولة : <b>5</b> ou السادة <br>");


define("LANGacce_dep2bis","<br><b>حذار! التحقق من طريقة الدخول<br> اختر حسابك المقابل.</b>");

define("LANGNA3bis","كلمة السر الولي "); //
define("LANGNA3ter","كلمة السر التلميذ "); //

define("LANGELE244","العنوان الإكتروني");

define("LANGTP12","الرجاء تأكيد فضائك");

define("LANGMESS40","لديك <strong> ");
define("LANGMESS40bis"," </strong> flux RSS مسجلة.");  // اضف "\" devant les quotes
define("LANGMESS41","فضاء ");  // Compte comme "compte utilisateur".
define("LANGMESS42","ثـان ارتبـاط");
define("LANGMESS43","آخر ارتبـاط يوم");

define("LANGALERT4","حذار ،  اختيار أسماء للمواضيع مختلفة.");

define("LANGMODIF26","تغيير  المادة الفرعية");
define("LANGPROF38","الأعداد الثلاثية");
define("LANGPROF39","تكملة معلومات");

define("LANGCIRCU21","إعفاء. لـ"); // abréviation من "Disponible pour" 

define("LANGTELECHARGE","تنزيل"); //  downloader

define("LANGPARENT15bis","عقوبة من");
define("LANGDISC2bis","اطبع العقوبات اليومية");

define("LANGRECH5","بين عنصر أو عناصر   للبحث");
define("LANGRECH6","فرز حسب الترتيب");

define("LANGPROFP33","ملء البطاقات");
define("LANGPROFP34","مراجعة البطاقة");
define("LANGPROFP35","تصفح أو تغيير  ملاحظات  البطاقات");


define("LANGPROFP36","لا يوجد أي تاريخ للثلاثي <br /><br /> تعيين لـ <u>هذه السنة الدراسية</u>");
define("LANGPROFP37","سجل  الملاحظات");

define("LANGGRP40","مجموعة مكونة");
define("LANGGRP41","هذه قائمة التلاميذ المسجلة");
define("LANGGRP42","هذه مجموعة موجودة فعلا");
define("LANGGRP43","ملف خطأ");
define("LANGGRP44","إحذف  مجموعة");
define("LANGGRP45","استيراد ملف");
define("LANGGRP46","إسم  المجموعة موجود -- خدمات ترياد");

define("LANGPARAM37","أكاديمية");
define("LANGAGENDA274","عيد اليومي ");
define("LANGPARAM38","سعيد عيد ميلاد  ");
define("LANGEDT1","F"); // première lettre
define("LANGEDT1bis","تنسيق الملف <b>xml</b><br>حجم الحد الأقصى ملف : ");
define("ERREUR3","اتصل بمسؤول ترياد لتفعيل الشبكة.");
define("LANGELE30","غيير كلمة السر");
define("LANGMESS44","إبعث رسـالة إلى تلميذ في ");
define("LANGMESS5","إبعث رسـالة إلى ولي في : ");
define("LANGMESS45","بعث رسالة إلى العنوان الإكتروني : ");
define("LANGMESS2","إبعـث رسـالة إلـىالإدارة : ");
define("LANGTRONBI9","التلاميذ");
define("LANGTRONBI10","الموظفون");
define("LANGTRONBI11","الصور الموظفون");
define("LANGTITRE15","وضع الأساتذة العامين أو المدرسين");
define("LANGPER7","تعيين  في قسم "); //
define("LANGPROF40","إرشادات إضافية");
define("LANGPROFP38","ملء أو تصفح في دفتر  المتابعة");
define("LANGEDIT2"," هاتف جوال 1");
define("LANGEDIT3","تهذيب ");
define("LANGEDIT4","إسم المسؤول. 2");
define("LANGEDIT5","الإسم المسؤول. 2");
define("LANGEDIT6","مكان الولادة");
define("LANGEDIT7","تهذيب ");
define("LANGEDIT8","إسم المسؤول. 1");
define("LANGEDIT9"," هاتف. جوال 2");
define("LANGEDIT10"," ولي");
define("LANGEDIT11","العنوان الإلكترني تلميذ");
define("LANGEDIT12"," هاتف. التلميذ");
define("LANGEDIT13","العنوان الإلكترني الواصي 2");
define("LANGEDIT14","اليوم");
define("LANGEDIT15","منذ 1 يوم");
define("LANGEDIT16","منذ 2 أيام");
define("LANGEDIT17","منذ 3 أيام");
define("LANGEDIT18","منذ 4 أيام");
define("LANGEDIT19","تأخير غير مبرر");
define("LANGEDIT20"," هاتف.جوال");
define("LANGSMS1","ارسال الرسائل القصيرة لتأخير منذ ");
define("LANGSMS2","غير محدد");
define("LANGSUPPLE","قائمة  المناوبين");
define("LANGSUPPLE1","عوضا عن ");
define("LANGTITRE2","أخبــــــار المعهــــــــــد");
define("LANGTITRE1","الأحـــــداث");

define("LANGDISC58","اضف  مادة   لتلميذ");
define("LANGDISC59","وضع الإدخال U.S.A.");
define("LANGDISC60","امتحان ");

define("LANGBT8","قائمة / تغيير المديرين ");
define("LANGBT9","قائمة / تغيير  الحياة المدرسية");
define("LANGBT10","قائمة / تغيير  الأساتذة");
define("LANGDIRECTION","الإدارة");

define("LANGTITRE36","التصرف في أعضاء الإدارة");
define("LANGTITRE37","التصرف في أعضاء اللحياة المدرسية");
define("LANGTITRE38","إدارة  المدرسين");
define("LANGTITRE39","إدارة البدائل");
define("LANGTITRE40","تلميذ");
define("LANGTITRE41","المسؤول."); // pour l'abréviation من "المسؤولonsable"
define("LANGTITRE42","ولي"); // dans في cadre familial
define("LANGTITRE43","التصرف في تلميذ");
define("LANGTITRE44","استيراد قائمة للتلاميذ");
define("LANGTITRE45","البحث تلميذ");
define("LANGCHERCH1","اعتمادا على معيار البحث");
define("LANGCHERCH2","نهاية  البحث");
define("LANGCHERCH3","عدد العناصر التي وجدت");
define("LANGPROF3bis","شاهد الواجبات ، والفروض والاستجوابات");
define("LANGTROMBI","صدر قائمةالتلاميذ إلى Wellصورة");
define("LANGPURG1","فسخ  معلومات");
define("LANGPUR2","فسخ  معلومات");
define("LANGPROFP39","الجدول المعدلات السنوية :");
define("LANGBLK1","تم تعطيل حسابك.<br /><br />حاولت الوصول إلى صفحة غير مصرح بها.<br /><br />لإعادة تنشيط حسابك ، من فضلك الاتصال بالمدرسة.<br /><br />فريق ترياد.");
define("LANGCARNET4","وصول");
define("LANGFORUM10bis","إسمك ");
define("LANGTPROBL11","سوف نقوم بالرد عليك في أقرب وقت ممكن. \\n\\n  فريق ترياد ");
define("LANGTRAD1","قائمة  العمليات التي اجريت");
define("LANGPARAM39","شهادة مسجلة");
define("LANGPARAM40","شهادة لا مسجلة");
define("LANGPARAM41","الملف يجب أن يكون مهيأ <b>rtf</b> أقل من 2Mo");
define("LANGBASE42","استيراد ملف");
define("ACCEPTER","قبول");
define("LANGCONDITION","أوافق على شروط");
define("LANGPARAM42","قائمة  التأخيرات أو الغيابات");
define("LANGCARNET5","تصفح في دفتر  المتابعة");
define("LANGCARNET6","ملء في دفتر  المتابعة");
define("LANGCARNET7","ملء");
define("LANGCARNET8","دفتر  المتابعة");
define("LANGCARNET9","تكوين  دفتر  المتابعة");
define("LANGCARNET10","تغيير  دفتر  المتابعة");
define("LANGCARNET11","إحذف  دفتر  المتابعة");
define("LANGCARNET12","تصفح  دفتر  المتابعة");
define("LANGCARNET13","تصدير دفتر المتابعة");
define("LANGCARNET14","إستورد  دفتر  المتابعة");
define("LANGCARNET15","استيراد ");
define("LANGCARNET16","تصدير");
define("LANGCARNET17","لائحة دفتر  المتابعة");
define("LANGCARNET18","إسم  دفتر  المتابعة");
define("LANGCONTINUER","واصل --->");
define("LANGCARNET19","انجاز  دفتر  المتابعة");
define("LANGCARNET20","يمكن لرموز التقييم يتم اختيارها من قبل المدرسين");
define("LANGCARNET21","حروف");
define("LANGCARNET22","أرقام");
define("LANGCARNET23","ألوان");
define("LANGCARNET24","الأعداد");
define("LANGCARNET25","(0 إلى 10 ou 0 إلى 20)");
define("LANGCARNET26","المراسلات");
define("LANGCARNET27","اكتسبت");
define("LANGCARNET28","إلى&nbsp;تأكيد");
define("LANGCARNET29","لا&nbsp;اكتسبت");
define("LANGCARNET30","في&nbsp;صدد&nbsp;اكتساب");
define("LANGCARNET31","لم&nbsp;تقيم");
define("LANGCARNET32","أخضر");
define("LANGCARNET33","أزرق");
define("LANGCARNET34","برتقالي");
define("LANGCARNET35","أحمر");
define("LANGCARNET36","فترة");
define("LANGCARNET37","فترات");
define("LANGCARNET38","إدارة  دفتر  المتابعة");
define("LANGCARNET39","عدد الفترات التي تتطلب توقيع  الآباء و الأساتذة و الإدارة");
define("LANGCARNET40","عدد ");
define("LANGCARNET41","الفروع المرتبطة بدفتر المتابعة");
define("LANGCARNET42","الشعب");
define("LANGCARNET43","الحد الأقصى من الخيارات 4 (4 أول من سيتم الحفاظ عليها)");
define("LANGCARNET44","دفتر إنشاؤه. يمكنك الآن إضافة إلى المهارات المرتبطة بهذا دفتر.");
define("LANGCARNET45","إضافة مجال الخبرة");
define("LANGCARNET46","إسم مجال الخبرة ");
define("LANGCARNET47","هل هذا العنوان يتطابق مع فئة من المهارات؟  ");
define("LANGCARNET48","إسم");
define("LANGCARNET49","إضافة مهارة");
define("LANGCARNET50","تغيير الخصائص العامة للدفتر");
define("LANGCARNET51","اضف مساحة الخبرة");
define("LANGCARNET52","تغيير مساحة الخبرة");
define("LANGCARNET53","بين في دفتر من المتابعة");
define("LANGCARNET54","دفتر المتابعة غير موجود");
define("LANGCARNET55","فحص دفتر المتابعة");
define("LANGCARNET56"," دفتر  المتابعة");
define("LANGCARNET57","شكل PDF التحصل على دفتر");
define("LANGCARNET58","تصدير دفتر  المتابعة");
define("LANGCARNET59","للتحصل على هذا الدفتر المتابعة");
define("LANGCARNET60","تغيير  دفتر  المتابعة");
define("LANGCARNET61","فسخ  دفتر  المتابعة");
define("LANGCARNET63","استيراد  دفتر  المتابعة");
define("LANGCARNET64","مذكرة للإستيراد");
define("LANGCARNET65","إحذف  كامل جدول الأوقات قبل الاستيراد؟");
define("LANGCARNET66","إلغاء الاستيراد. <br>اسم هذا الكتاب موجود بالفعل! <br/> الرجاء إزالة هذا الكتاب قبل القيام الاستيراد.");
define("LANGCARNET62","تحذير! كل الملاحظات وتخضع لمراقبة خط سير الرحلة سيتم حذف!");
define("LANGEDT2","توريد جدول الأوقات  جدولة المواعيد البصرية");
define("LANGEDT3","توريد  جدولة المواعيد البصرية انتهاء");
define("LANGEDT4","كشف / إدارة جدول الأوقات");
define("LANGEDT5","إستورد الجدول الزمني مرئي جدولة المواعيد");
define("LANGEDT6","تصدير ترياد مرئي لجدولة المواعيد");
define("LANGEDT7","كشف / إدارة جدول الأوقات");
define("LANGEDT8","يدبر");
define("LANGEDT9","إنشاء جدول الأوقات");
define("LANGEDT10","SQLite لا يؤيد الوحدة. من فضلك تحقق من صحة خادم لدعم  SQLite.");
define("LANGGRP47","البحث عن مجموعات");
define("LANGGRP48","قائمة مجموعات التلميذ");
define("LANGGRP49","قائمة مجموعات");
define("LANGDISP21","غياب");
define("LANGDISP22","تسجيل الأسباب ");
define("LANGDISP23","عنوان السبب ");
define("LANGDISP24","قائمة الأسباب ");
define("LANGDISP25","عدد التلاميذ تحديث");
define("LANGDISP26","الملف يجب أن يكون مهيأ xls");
define("LANGCARNET63","انتهاء استيراد دفتر المتابعة  ");
define("LANGCARNET64","قائمة  العقوبات");
// News 2
define("LANGCARNET67","إضافة عقوبة تأديبية");
define("LANGCARNET68","جدول");
define("LANGVIES1","إسم الشخص الذي يعلق على البطاقة");
define("LANGVIES2","ضارب  اعداد   الحياة مدرسية   في البطاقة");
define("LANGVIES3","ضارب مدرس");
define("LANGVIES4","ضارب الحياة المدرسية");
define("LANGVIES5","قائمة  المدرسين");
define("LANGVIES6","معلومات مدرسية إضافية");


define("LANGVIES7","سجل  الأعداد مع ملاحظات");
define("LANGVIES8","طباعة  الغيابات  لقسم");
define("LANGVIES9","بين  الشهر");
define("LANGVIES10","بين  قسم ");
define("LANGPDF1","ملف PDF للجميع");
define("LANGPDF2","ملف واحد PDF لكل التلميذ");
define("LANGEDIT5bis","إسم المسؤول. 1");
define("LANGGRP50","تغيير في إسم لمجموعة");
define("LANGGRP51","إسم  المجموعة");
define("LANGGRP52","تغيير وحدة");
define("LANGGRP53","إسم جديد للمجموعة");
define("LANGGRP54","أو في بيان الأعداد");
define("LANGGRP55","إختبار");
define("LANG1ER","1سـ ");
define("LANG2EME","2سـ ");
define("LANG3EME","3سـ ");
define("LANG4EME","4سـ ");
define("LANG5EME","5سـ ");
define("LANG6EME","6سـ ");
define("LANG7EME","7سـ ");
define("LANG8EME","8سـ ");
define("LANG9EME","9سـ ");
define("LANGGRP56","اسناد العدد على");
define("LANGGRP57","احتفظ");
define("LANGGRP58","تحذير,  أعداد التلاميذ المختارة   للفسخ <br /> ستفسخ كل  الأقسام المستعملين هذه المجموعة !!!");
define("LANGGRP59","ازلة التلاميذ لم تعد تنتمي إلى مجموعة");
define("LANGGRP60","تغيير  القائمة");
define("LANGPARAM3","<font class=T1>أدخل النص لمضمون شهادة التعليم. لإدراج اسم ولقب وعنوان الممتحن تلقائيا في كل وثيقة ، يرجى présisé سلسلة NomEleve الاخبار </b> ، PrenomEleve الاخبار </b> أخبار AdresseEleve </b> ، CodePostalEleve الاخبار </b> وVilleEleve الاخبار </b> ص للموقع المطلوب. وبالمثل ، يمكن أن تشير إلى الطبقة مع الكلمة ClasseEleve الاخبار </b> أو ClasseEleveLong الاخبار </b> ، وتاريخ الميلاد مع DateNaissanceEleve الاخبار </b> ، مكان الولادة من خلال < ب> LieuDeNaissance </b> ، التاريخ الحالي عبر DateDuJour الاخبار </b> ، السنة الدراسية عبر AnneeScolaire الاخبار </b> ، والجنسية عن طريق الجنسية الاخبار </b>. </font><br><br>");
define("LANGEDIT20bis","حذف");  // abréviation من إحذف  sur 3 lettres seulement
define("LANGGRP61","الرجوع إلى التحديث");
define("LANGRTDJUS","مبرر"); // pour un تأخير
define("LANGABSJUS","مبرر"); // pour une abs
define("LANGPARAM2","<font class=T1>أدخل النص عن محتوى هذا التأخير لإرسال رسالة إلى أولياء الأمور. يمكنك تحديد المعلومات التالية : اسم الطالب : NomEleve الاخبار </b> -- اسم الطالب : PrenomEleve الاخبار </b> -- العنوان : AdresseEleve الاخبار </b> -- الرمز البريدي : : أخبار CodePostalEleve </b> -- المدينة : VilleEleve الاخبار </b> -- فئة التلاميذ : ClasseEleve الاخبار </b> -- الموعد المتأخر : RTDDATE الاخبار </b> -- التوقيت تأخير : RTDHEURE الاخبار </b> -- التشغيل : RTDDUREE الاخبار </b> -- تراكم غياب : CumulABS الاخبار </b> </font><br> ");
define("LANGPARAM1","<font class=T1>اكتب رسالتك النصية المحتوى الخاص بك إلى عدم وجود بريد الكتروني للوالدين. يمكنك تحديد المعلومات التالية : اسم الممتحن : NomEleve الاخبار < /b> -- اسم الممتحن : PrenomEleve الاخبار < /b> -- العنوان : AdresseEleve الاخبار < /b> -- الرمز البريدي : : أخبار CodePostalEleve < /b> -- المدينة : VilleEleve الاخبار < /b> -- الدرجة الاولى للمرشح : ClasseEleve الاخبار < /b> -- تاريخ بدء الغياب : ABSDEBUT الاخبار </b> -- تاريخ الانتهاء من الغياب : ABSFIN الاخبار < /b> -- التشغيل : ABSDUREE الاخبار < /b> -- الاسم من 1 : أخبار NomResponsable1 < /b> -- 1 المسؤولين العنوان : أخبار AdresseResponsable1 < /b> -- مدير المدينة 1 : أخبار VilleResponsable1 < /b> -- تراكم غياب : CumulABS الاخبار < /b> - Date du jour : <b>DATEDUJOUR</b> </font> <br>");
define("LANGGRP62","مراجعة");
define("LANGGRP63","مراسلات");
define("LANGDELEGUE1","مندوب");
define("LANGEDT10bis"," SimpleXML وحدة نمطية غير معتمدة. الرجاء التحقق من الخادم الخاص بك لدعم تمديد SimpleXML.");
define("LANGBULL45","بعث رسالة إلى كل  الاساتذة المختارة  لإعلامهم بملء  البطاقات.");
define("LANGBULL46","عدد  البطاقات المملوئة في القسم");
define("LANGMESS46","شاهد في");
define("LANGMESS47","إحذف  إحتفاظ أو  عقوبة");
define("LANGCOUR","المراسلة انتهاء");
define("LANGCOUR1","قائمة الإبقا لا التي اجريت");
define("LANGCOUR2","تكوين مراسلات  الإحتفاظ");
define("LANGPARAM43","<font class=T1>اكتب رسالتك النصية ضبط النفس المحتوى الخاص بك البريد الإلكتروني للوالدين. يمكنك تحديد المعلومات التالية : اسم الطالب : NomElève الاخبار </b> -- اسم الطالب : PrénomElève الاخبار </b> -- العنوان : AdresseEleve الاخبار </b> -- الرمز البريدي : : أخبار CodePostalElève </b> -- المدينة : VilleEleve الاخبار </b> -- فئة التلاميذ : ClasseEleve الاخبار </b> -- تاريخ ضبط النفس : DATEالإبقاء الاخبار </b> -- الوقت من الاحتفاظ : HEUREالإبقاء الاخبار </b> -- التشغيل : الإبقاءDUREE الاخبار </b> -- السبب : الإبقاءMOTIF الاخبار </b> -- الفئة : أخبار الإبقاءCATEGORY </b> -- جوائز من قبل : أخبار عدد معين </b> -- واجب البحث : DEVOIRAFAIRE الاخبار </b> -- الحقائق :<b>FAITS</b>  - Civilit� tuteur 1 : <b>CIVILITETUTEUR1</b> - Nom du responsable 1 : <b>NOMRESP1</b> Pr�nom du responsable 1 : <b>PRENOMRESP1</b> - Date du jour : <b>DATEDUJOUR</b> </font><br><br>");
define("RESA75","معلومات إضافية");
define("LANGCOM","انقاذ جميع تعليقاتكم في المكتبة.");
define("LANGCOM1","قيمة الحد الأقصى يجب أن تكون أكبر من قيمة الحد الأدنى.");
define("LANGCOM2","يجب أن تكون جميع المجالات المحددة على الوجه الصحيح.");
define("LANGCOM3","عدد التلاميذ : ");
define("LANGSTAGE91","إسم المسؤول");
define("LANGSTAGE93","دور المسؤول.");
define("LANGSTAGE94","الشركة");
define("LANGSTAGE95","مؤسسة");
define("LANGSTAGE96","عدد العناصر التي وجدت");
define("LANGSTAGE97","بين إلى وجود قيمة رقمية ، الرجاء");
define("LANGSTAGE98","أدخل تاريخ بدء التدريب ، من فضلك");
define("LANGSTAGE99","بيين تاريخ نهاية التدريب ، من فضلك");
define("LANGPATIENTE","من فضلك انتظر");
define("LANGSMS3","رقم الهاتف الجوال");
define("LANGSMS4","150 حروف الحد الأقصى");
define("LANGSMS5","رسالة");
define("LANGSMS6","إرسال رسالة نصية قصيرة يتم تخزينها والوصول إليها من قبل الإدارة");
define("LANGSMS7","ارسال الرسائل القصيرة");
define("LANGSMS8","إرسال رسالة نصية");
define("LANGSMS9","قائمة   الأولياءأرقام هواتف<br> من ");
define("LANGSMS10","إرسال رسالة نصية قصيرة إلى قسم");
define("LANGSMS11","أرسل رسالة قصيرة إلى والد  تلميذ باستخدام اسمه");
define("LANGSMS12","أرسل رسالة قصيرة إلى  شخص باستخدام  إسم");
define("LANGSMS13","أرسل رسالة قصيرة إلى  شخص باستخدام  رقم");
define("LANGSMS14","رقم");
define("LANGbasededoni54_5","القيمة المقبولة : <b>7</b> ou P <br>");
define("LANGbasededoni54_6","القيمة المقبولة : <b>8</b> ou Sr <br>");
define("LANGGRP27bis","اضف  تلميذ في عديد من مجموعات ");
define("LANGGRP28bis","زيادة التلميذ في مجموعة");
define("LANGGRP29bis","اكتب&nbsp;/&nbsp;غيير");
define("LANGNOTEUSA6","إنسجام الأعداد لإصدار أعداد أمريكية");
define("LANGNOTE1","عنوان الإمتحان");
define("LANGPARAM44","تلقى رسالة عندما تتلقى معلومة من نوع");
define("LANGMESS17bis","التكوين.");
define("LANGNNOTE2","فرز حسبقسم");
define("LANGNNOTE3","فرز  حسب إسم");
define("LANGNNOTE4","بينلعنوان الوثيقة");
define("LANGBULL47","البطاقة بدون  المواد الفرعية");
define("LANGBULL48","البطاقة   بالمواد الفرعية");
define("LANGBULL49","البطاقة امتحان تجريبي");
define("LANGMESS48","صندوق الحذف");
define("LANGMESS49","لا يوجد أي تلميذ متربص في شركة.");
define("LANGMESS50","الخريطة القسم");
define("LANGMESS51","بين المواد الاختيارية");
define("LANGMESS52","(الأعداد حسبت في المعدل العام ، إذا كانت متفوقة إلى 10/20)");
define("LANGMESS53","الأسبوع المـاضي");
define("LANGMESS54","الأسبوع الموالي");
define("LANGMESS55","جدول أوقات القسم");
define("LANGMESS56","أي التلميذ");
define("LANGMESS57","معرف");
define("LANGMESS58","هذا الحساب لا يوجد لديه عدد.");
define("LANGMESS59","تغير أيضا غياب / تأخير مبررة");
define("LANGMESS60","  إلـى");
define("LANGMESS60bis","غائب");
define("LANGMESS61","الأساتذة");
define("LANGMESS62","ولي ");
define("LANGMESS63","اليوم");  // mettre une ' 
define("LANGBT27bis","سجل غياب/تأخير"); //
define("LANGDEPART3bis","وصول توقف!");
define("LANGDEPART4bis","الوصول إلى حسابك في ترياد هو حاليا مكسورة ، شكرا لك على الاتصال بالمدرسة من أجل معلومات أكثر.");
define("LANGAIDE","لتعليمات الفورية");
define("LANGAIDE1","بين إلى المراسلات بين المواد المسجلة في ترياد والمواد التي تدرس اشهادت المعاهد . للقيام بذلك ، قم بعملية السحب والإسقاط (جر  الإفراج عنها) بين المواد من اليسار إلى اليمين.");
define("LANGAIDE2","ألف النصك لمضمون اتفاق التربص. من أجل النظر في بعض العناصر مثل الاسم ، العنوان ، الخ... ، يرجى تحديد السلسلة التالية لتناسب احتياجاتك :");
define("LANGBREVET1","ادخل");
define("LANGCONFIG4"," حذر عندما تكون هناك رسالة");
define("LANGCONFIG5","عدد الغيابات بدون عذر لتلميذ قد تجاوز ");
define("LANGCONFIG6","عدد من تأخيرات بدون مبرر لتلميذ قد تجاوز ");
define("LANGCONFIG7","مرة");
define("LANGCONFIG8","قائمة المستخدمين الذين وقع تحذيرهم");

define("LANGMESS64","الاشخاص الذين تلقوا هذه الرسالة");
define("LANGMESS65","قائمة القوانين الداخلية");
define("LANGMESS66","المدير");
define("LANGMESS67","لقد قرأت في مختلف الوثائق المذكورة أعلاه");
define("LANGMESS68","  لقد قبلت القانون أو القوانين الداخلية");
define("LANGMESS69","أوافق على الشروط العامة للتعليم");
define("LANGMESS70","لقانون سهل البلوغ للمدرسين");
define("LANGMESS71","عاين حالة القوانين");
define("LANGMESS72","اطبـع حالة القوانين");
define("LANGMESS73","قائمة الدفع الغير مدفوع أو الغير المكتمل");
define("LANGMESS74","كشف القوانين");
define("LANGacce_dep2ter","<br><b>تحذير! التحقق من طريقة والصول ، اختر حسابك المقابل.</b>");
//NEW NON CORRIGE

define("LANGMESS75","Retour menu principal");
define("LANGMESS76","Correspondance");
define("LANGMESS77","(devoir, contr�le, examen)");
define("LANGMESS78","Trier par ");
define("LANGMESS79","Notes visibles pour les �l�ves le ");
define("LANGMESS80","vie scolaire");
define("LANGMESS81","Connexion en cours");
define("LANGMESS82","Moyenne");
define("LANGMESS83","Moyenne de classe");
define("LANGMESS84","Max");
define("LANGMESS85","Min");
define("LANGMESS86","Aucune date trimestrielle affect�e");
define("LANGMESS86bis","pour");
define("LANGMESS86ter","cette ann�e scolaire");
define("LANGMESS87","Note des devoirs de");

define("LANGMESS88","Cahier de texte enregistr�  -- Service Triade");
define("LANGMESS89","Cahier de texte en ");
define("LANGMESS90","Penser � enregistrer votre contenu avant de changer d'onglet.");
define("LANGMESS91","Consultation de la semaine");
define("LANGMESS92","Contenu du cours");
define("LANGMESS93","Fichier joint");
define("LANGMESS94","Piece Jointe");
define("LANGMESS95","Objectif du cours");
define("LANGMESS96","Devoir � faire pour le ");
define("LANGMESS97","non indiqu�");
define("LANGMESS98","Devoir � faire");
define("LANGMESS99","Bloc-Notes");
define("LANGMESS100","Consultation compl�te");
define("LANGMESS101","Validation");
define("LANGMESS102","Consultation");
define("LANGMESS103","Temps estim� pour ce travail ");
define("LANGMESS104","Temps de travail estim� � ");
define("LANGMESS105","Fichier ");
define("LANGMESS106","Modification ");
define("LANGMESS107","Supprimer cette fiche ");
define("LANGMESS108","Temps de travail total estim� ");
define("LANGMESS109","du"); // notion de date du xxxx au xxxx
define("LANGMESS110","au"); // notion de date du xxxx au xxxx
define("LANGMESS111","Format PDF"); 
define("LANGBT288","Consulter / Modifier");
define("LANGSITU1","Mari�(e)"); //
define("LANGSITU2","Divorc�(e)"); //
define("LANGSITU3","Veuf"); //
define("LANGSITU4","Veuve"); //
define("LANGSITU5","Concubin"); //
define("LANGSITU6","PACS"); //
define("LANGSITU7","C�libataire");
define("LANGFIN002","Ech�ancier");//
define("LANGFIN003","Ech�ancier");//
define("LANGFIN004","Aucune date de configur�e");//
define("LANGCONFIG","Configurer");//

define("LANGMESS112","Commentaire bulletin trimestre/semestre");
define("LANGMESS113","Choix du commentaire");
define("LANGMESS114","Commentaire brevet des coll�ges");
define("LANGMESS115","Visualisation du bulletin de classe");
define("LANGMESS116","Acc�der");
define("LANGMESS117","S�rie");
define("LANGMESS118","Passer en mode �tendu");
define("LANGMESS119","Appr�ciations, Conseils pour progresser");
define("LANGMESS120","Points d'appui. Progr�s. Efforts");
define("LANGMESS121","Ecarts par rapport aux objectifs attendu");
define("LANGMESS122","Conseils pour progresser");
define("LANGMESS123","Moyenne de la classe");
define("LANGMESS124","Commentaire pr�c�dent");
define("LANGMESS125","Ajout dans liste"); // v�rif. pas de quote (') 
define("LANGMESS126","Enregistrer le commentaire"); // v�rif. pas de quote (') 
define("LANGMESS127","Revenir et cliquer sur"); // v�rif. pas de quote (') 
define("LANGMESS128","Enregistrement");  // v�rif. pas de quote (') 
define("LANGMESS129","Consulter");
define("LANGMESS130","Moy. Pr�c�dente");
define("LANGMESS131","Enregistrer les commentaires");
define("LANGMESS132","Patientez S.V.P.");
define("LANGMESS133","Commentaire vide");
define("LANGMESS134","commentaire non enregistr�");
define("LANGMESS135","Appr�ciation pour le bulletin trimestriel classe");
define("LANGMESS136","cliquez-ici");
define("LANGMESS137","Information Scolaire Compl�mentaire");
define("LANGMESS138","Saisir autres commentaires pour les bulletins");

//-----------------Traduction Sam le 06/06/2014
//-----------------messagerie_brouillon.php
define("LANGMESS139","Messagerie brouillon");
define("LANGMESS140","Pr�parer un brouillon ");
define("LANGMESS141","Acc�s");
define("LANGMESS142","Valider un brouillon");
define("LANGMESS143","Les messages brouillons sont visibles par tous les membres de la direction");

//------------------param.php
define("LANGMESS144","Signature du directeur");
define("LANGMESS145","Ann�e scolaire");
define("LANGMESS156","Pays");
define("LANGMESS159","Choix du site");
define("LANGMESS160","Nouveau site");
define("LANGMESS177","D�partement ");
//------------------definir_trimestre.php
define("LANGMESS146","Enregistrement au format semestriel.");
define("LANGMESS147","Toutes les classes");
define("LANGMESS148","Liste des p�riodes trimestrielles ou semestrielles ");
define("LANGMESS149","Modifier");
define("LANGMESS150","Supprimer");
define("LANGMESS157","Trimestre");
define("LANGMESS158","Classe");
//-----------------probleme_acces_2.php
define("LANGMESS151","Identifiez votre compte");
define("LANGMESS152","Veuillez d�abord identifier votre compte pour r�initialiser votre mot de passe.");
define("LANGMESS153","Demande de mot de passe");
//-----------------geston_groupe.php
define("LANGMESS154","Cr�ation de groupe");
define("LANGMESS155","Liste des groupes des enseignants");
//-----------------gestcompte.php
define("LANGMESS161","Gestion de votre compte");
//-----------------messagerie_reception.php
define("LANGMESS162","Gestion de votre compte");
//------------------gestion_groupe.php
define("LANGBT53","Entr�e"); // traduit par sam le 09/06/2014
define("LANGMESS163","V�rification des groupes");
//-------------------messagerie_suppression.php
define("LANGMESS164","Boite de suppression");
define("LANGMESS165","Archiver dans");
//-------------------messagerie_reception.php
define("LANGMESS166","Boite de reception");
//-------------------parametrage.php
define("LANGMESS167","Param�trage de votre compte");
define("LANGMESS168","Actualit�s");
define("LANGMESS169","R�servation Salle / Equipement");
define("LANGMESS170","Messagerie Triade");
define("LANGMESS171","(Indiquer votre  email)");
define("LANGMESS172","(Num�ro de portable)");
// TTTTTTTT
//-------------------messagerie_envoi.php
define("LANGMESS173","Message � un groupe ");
define("LANGMESS174","Message aux d�l�gu�s :");
define("LANGMESS175","Message � un membre du personnel : ");
define("LANGMESS176","Message � un tuteur de stage : ");
//-------------------creat_admin.php
define("LANGMESS178","Civ.");
define("LANGMESS179","Indice&nbsp;salaire");
//-------------------creat_tuteur.php
define("LANGMESS180","Cr�ation d'un compte tuteur de stage");
define("LANGMESS181","Liste / Modification d'un tuteur de stage");
define("LANGMESS182","Gestion des membres Tuteur de stage");
define("LANGMESS183","Entreprise li�e");
define("LANGMESS184","En qualit� de ");
//--------------------creat_personnel.php
define("LANGMESS185","Gestion des membres du Personnel");
define("LANGMESS186","Cr�ation d'un compte personnel"); // "Cr&eacute;ation d'un compte personnel"
//--------------------creat_eleve.php
define("LANGMESS187","Rechercher");
define("LANGMESS188","Importer");
define("LANGMESS189","Supprimer");
define("LANGMESS190","Lv1/Sp� :");
define("LANGMESS191","Lv2/Sp� :");
define("LANGMESS192","Boursier");
define("LANGMESS193","Inscription au BDE");
define("LANGMESS194","Inscription � la biblioth�que");
define("LANGMESS195","Montant Bourse");
define("LANGMESS196","Indemnit� Stage");
define("LANGMESS197","Code comptabilit� ");
define("LANGMESS198","Adresse");
define("LANGMESS199","T�l�phone");
define("LANGMESS200","T�l. Portable");
define("LANGMESS201","E-mail Etudiant");
define("LANGMESS202","E-mail universitaire");
define("LANGMESS203","Situation Familiale");
define("LANGMESS204","Copier adresse");
define("LANGMESS205","Classe ant�rieure");
//--------------------creat_class.php
define("LANGMESS206","Intitul� de la classe");
define("LANGMESS207","Ecole");
//--------------------creat_matiere.php
define("LANGMESS208","Format court");
define("LANGMESS209","Format long");
define("LANGMESS210","Code mati�re");
//--------------------reglement.php
define("LANGMESS211","R�glement int�rieur");
define("LANGMESS212","Ajouter un r�glement");
define("LANGMESS213","lister le/les r�glements");
define("LANGMESS214","Supprimer un r�glement");
//--------------------sms.php
define("LANGMESS215","Gestion des SMS");
define("LANGMESS216","Membre");
define("LANGMESS217","Direction");
define("LANGMESS218","Enseignant");
define("LANGMESS219","Vie Scolaire");
define("LANGMESS220","Personnel");
//--------------------Codebar0.php
define("LANGMESS221","Code barre :");


//--------------------vatel_gestion_ue.php
define("LANGMESS222","Gestion des Unit�s d'enseignements");
define("LANGMESS223","Cr�ation d'une unit� d'enseignement");
define("LANGMESS224","Lister/Modifier");
//--------------------base_de_donne_importation.php
define("LANGMESS225","Fichier Excel");
define("LANGMESS226","Fichier XML");
define("LANGMESS227","Code barre");
//--------------------edt.php
define("LANGMESS228","Suppression d'une p�riode ");
define("LANGMESS229","Ajustement des horaires ");
define("LANGMESS230","P�riode visible sur l'EDT");
define("LANGMESS231","Importer image ou pdf : ");
define("LANGMESS232","(format  de l'image : jpg et moins de 2Mo )");
define("LANGMESS233","EDT de la classe : ");
//--------------------export.php
define("LANGMESS234","Exportation des donn�es");
define("LANGMESS235","Informations � exporter");
define("LANGMESS236","Personnel");
define("LANGMESS237","Choix de l'extraction : ");
//--------------------export.php
define("LANGMESS238","Nom de l'enseignant ");
define("LANGMESS239","Exportation au format PDF : ");
define("LANGMESS240","Exporter");
//--------------------commaudio.php
define("LANGMESS241","Sujet : ");
define("LANGMESS242","Fichier audio : ");
//--------------------consult_classe.php
define("LANGMESS243","Impression ");
define("LANGMESS365","&nbsp;Demi&nbsp;Pension&nbsp;");
define("LANGMESS366","&nbsp;Interne&nbsp;");
define("LANGMESS367","&nbsp;Externe&nbsp;");
define("LANGMESS368","&nbsp;Inconnu&nbsp;");
//--------------------resr_admin.php
define("LANGMESS244","R�server via E.D.T.");
//--------------------carnetnote.php
//------------modif nom de l'enseignant---LANGMESS238
//--------------------publipostage.php
define("LANGMESS245","Type membre : ");
define("LANGMESS246","Parents");
define("LANGMESS247","Etudiants");
define("LANGMESS248","Type adresse :");
define("LANGMESS249","Tuteur");
define("LANGMESS327","Publipostage");
define("LANGMESS328","Afficher la civilit&eacute; des &eacute;tudiants : ");
define("LANGMESS329","Afficher matricule : ");
define("LANGMESS330","Afficher Classe : ");
define("LANGMESS331","Afficher Adresse : ");


////////////////////////////////////////////////////////////////////// A revoir
//--------------------ficheeleve3.php
define("LANGMESS250","Listing Classe");
define("LANGMESS251","Envoyer un SMS");
define("LANGMESS252","Modifier Fiche");
define("LANGMESS253","Affecter &agrave; un stage");
define("LANGMESS254","Bloquer ce compte");
define("LANGMESS255","D�bloquer ce compte");
define("LANGMESS259","Renseignements");
define("LANGMESS260","Carnet de notes");
define("LANGMESS261","Vie Scolaire");
define("LANGMESS262","Disciplines");
define("LANGMESS263","Op�rations effectu�es");
define("LANGMESS264","Info. Tuteur 1");
define("LANGMESS265","Info. Tuteur 2");
define("LANGMESS266","Info. Etudiant");
define("LANGMESS267","Archives");
define("LANGMESS268","Info. m�dicales");
define("LANGMESS269","info. compl.");
define("LANGMESS270","Nom :");
define("LANGMESS271","Pr�nom :");
define("LANGMESS272","Classe :");
define("LANGMESS273","Date&nbsp;de&nbsp;nais.&nbsp;:");
define("LANGMESS274","Nationalit�&nbsp;:");
define("LANGMESS275","Lieu&nbsp;naissance&nbsp;:");
define("LANGMESS276","Boursier :");
define("LANGMESS277","Num�ro&nbsp;Etudiant&nbsp;:");
define("LANGMESS278","Lv1/Sp� :");
define("LANGMESS279","Lv2/Sp� :");
define("LANGMESS280","Option :");
define("LANGMESS281","R�gime :");
define("LANGMESS282","N�&nbsp;Rangement&nbsp;:");
define("LANGMESS283","Contact&nbsp;:");
define("LANGMESS284","Situation&nbsp;familiale&nbsp;:");
define("LANGMESS285","Adresse&nbsp;:");
define("LANGMESS287","Code&nbsp;Postal&nbsp;:");
define("LANGMESS288","Ville&nbsp;:");
define("LANGMESS289","Email&nbsp;:");
define("LANGMESS290","T�l�phone&nbsp;:");
define("LANGMESS291","Profession&nbsp;:");
define("LANGMESS292","T�l.&nbsp;Prof.&nbsp;:");
define("LANGMESS293","Sexe&nbsp;:");
define("LANGMESS294","Classe&nbsp;ant.&nbsp;:");
define("LANGMESS295","Ann�e&nbsp;Scolaire");
define("LANGMESS296","Trim&nbsp;/&nbsp;Sem");
define("LANGMESS297","Bulletin");
define("LANGMESS298","Effectu�&nbsp;le");
define("LANGMESS308","Permission non accord�es");
define("LANGMESS309","Ajouter une information");
define("LANGMESS310","Entretien individuel");
define("LANGMESS311","Planifier abs/rtd");
define("LANGMESS312","Modifier abs/rtd");
define("LANGMESS313","Supprimer abs/rtd");
define("LANGMESS320","$email_eleve / $emailpro_eleve");
define("LANGMESS321","$tel_eleve / $tel_fixe_eleve");

//--------------------elevesansclasse.php
define("LANGMESS256","Save");
//--------------------consult_classe.php
define("LANGMESS257","All classes.");
//--------------------ficheeleve.php
define("LANGMESS258","Search");
//--------------------newsactualite.php
define("LANGMESS299","    Titre : ");
define("LANGMESS300","Votre TRIADE n'est pas configur� en acc�s Internet, veuillez consulter votre compte administrateur Triade pour valider l'option de la connexion Internet.");
define("LANGMESS365","Actualit�s  de la 1er page");
//--------------------actualiteetablissement.php
//--------------------newsdefil.php
//--------------------commaudio.php // Bouton Parcourir
//--------------------commvideo.php
define("LANGMESS301","Lien de la video : ");
define("LANGMESS302","ou Lien Youtube : ");
//--------------------emmargement.php
// ICIIIIIIIICICICICICIC
define("LANGMESS303","Gestion des �margements ");
define("LANGMESS304","Au niveau de la classe");
define("LANGMESS305","Emargement vierge");
define("LANGMESS306","Emargement vierge d'examen");
define("LANGMESS306","Emargement vierge d'examen");
define("LANGMESS307","Au niveau du groupe");
define("LANGMESS314","Emargement du jour ");
define("LANGMESS315","Emargement&nbsp;du&nbsp;");
define("LANGMESS316","Pour la classe : ");
define("LANGMESS317","Enseignant : ");
define("LANGMESS318","Tous les enseignants : ");
define("LANGMESS319","Hauteur des cellules des �l�ves");
//--------------------trombinoscope0.php
define("LANGMESS322","Imprimer au format PDF");
define("LANGMESS323","Importer les photos au format ZIP");
//--------------------chgmentclas.php
define("LANGMESS324",": notes, absences, retards, dispences, sanctions, retenues, Brevets, Commentaires bulletin de l'�l�ve, droits de scolarit�, plan de classe, Brevets, Affectation stage");
//------LANGASS10-- Variable pour suppression
//--------------------certificat.php
define("LANGMESS325","Param�trage  manuel : ");
define("LANGMESS326","Param�trage  import : ");
//define("LANGMESS331","Publipostage");
//--------------------visa_direction.php
define("LANGMESS332","Type du bulletin : ");
// VALIDER CHANGER PAR ENTER-->LANGMESS116
define("LANGMESS333","Valider");
define("LANGMESS334","Annuel"); /// voir si posible de mettre une variable
///////////////////////
//--------------------list_classe.php----- Voir comment changer le bouton Modifier
//--------------------list_matiere.php---- Voir comment changer le bouton Modifier
//--------------------listepreinscription.php
define("LANGMESS335","Liste des pr�-inscriptions");
//--------------------reglement_ajout.php
define("LANGMESS336","R�glement int�rieur");
define("LANGMESS337","r�glement");
define("LANGMESS338","la ou les classe(s)");
define("LANGMESS339","la ou les classe(s)");
//--------------------affectation_visu.php
define("LANGMESS340","Ann�e/Trimestre/Semestre");
define("LANGMESS341","Toute l'ann�e");
define("LANGMESS342","Trimestre 1 / Semestre 1");
define("LANGMESS343","Trimestre 2 / Semestre 2");
define("LANGMESS344","Trimestre 3");
//--------------------affectation_modif_key.php
//----Modidifier le bouton suivant par next
//--------------------reglement_ajout.php
//--------------------reglement_liste.php
// comment modifier le lien Reglement interieur
//----------------/reglement_supp.php
define("LANGMESS345","Visualiser");
//-----------------vatel_list_ue.php
define("LANGMESS346","Gestion des Unit�s d'Enseignements");
define("LANGMESS347","Filtre : ");
define("LANGMESS348","Modifier");
define("LANGMESS349","Supprimer");
define("LANGMESS350","Nom UE");
define("LANGMESS351","Sem.");
define("LANGMESS352","Cr�ation d'une UE");

//----------------creat_groupe.php
define("LANGMESS353","Fichier excel");
define("LANGMESS354","Contenu du fichier excel");
//----------------visa_direction2.php
define("LANGMESS355","Commentaire des enseignants");
define("LANGMESS356","Visa direction");
//----------------imprimer_tableaupp.php
define("LANGMESS357","Impression tableau de notes trimestriel ou semestriel");
define("LANGMESS358","Afficher le classement ");
define("LANGMESS359","Afficher les colonnes vides ");
define("LANGMESS360","Regroupement par module ");
define("LANGMESS361","Afficher les mati�res ");
define("LANGMESS362","Tableau des diff�rentes moyennes au format excel");
define("LANGMESS374","Jusqu'au :");
define("LANGMESS375","Fichier Excel");
//------------------affectation_creation_key.php
//------------------affectation_visu2.php
define("LANGMESS363","Visu<i>*</i>");
define("LANGMESS364","Unit� Ens.");
//------------------entretien.php
define("LANGMESS369","Journal d'entretiens individuels");
define("LANGMESS370","Journal d'entretiens group�s ");
define("LANGMESS371","Tableau r�capitulatif");
define("LANGMESS372","&nbsp;Enseignants&nbsp;");
define("LANGMESS373","&nbsp;Nombre&nbsp;d'heures&nbsp;");
//------------------base_de_donne_key.php
define("LANGMESS376","Pour modifier / changer votre code d'acc�s, merci de consulter votre compte ");
define("LANGMESS377","administrateur Triade");
define("LANGMESS378","puis le module 'code d'acc�s'");
//------------------chgmentClas0.php
// ann�e = Year
define("LANGMESS379","pas d'ann�e");
define("LANGMESS380","Choix de la classe");
//------------------chgmentClas00.php
// ann�e et pas d'ann�e 
define("LANGMESS381","Choix des classes :");
define("LANGMESS383","Changement de classe pour les �l�ves en ");
define("LANGMESS384","Passage pour l'ann�e scolaire");
define("LANGMESS385","Sans classe");
//------------------brouillon_reception.php
define("LANGMESS382","Liste des messages brouillons");
//------------------imprimer_trimestre.php
define("LANGMESS386","Bulletin&nbsp;personnalis�");
define("LANGMESS387","Bulletin d�finit pour les enseignants (et parents  prochainement)");
define("LANGMESS388","Visible pour la classe");
define("LANGMESS389","Autoriser l'acc�s aux bulletins pour les enseignants");
//LANGMESS389

define("LANGMESST390","Merci de renseigner les informations n�cessaires � Triade pour le site num�ro 1 !!<br>Merci de confirmer en validant ou revalidant le formulaire suivant.");
define("LANGMESST391","Supprimer site");
define("LANGMESST392","Carnet de suivi");
define("LANGMESST393","COMPTE BLOQUE");
define("LANGMESST394","COMPTE EN PERIODE PROBATOIRE");
define("LANGMESST395","Supprimer la p�riode probatoire");
define("LANGMESST396","Mise en p�riode probatoire");
define("LANGMESST397","Saisie&nbsp;par");
define("LANGMESST398","Enregistrer cette liste");
define("LANGMESST399","Effectuer une recherche complexe");
define("LANGMESST700","Supprimer message en cours");
define("LANGMESST701","Actualit�s  de la 1er page");
define("LANGMESST702","Titre de la vid�o");
define("LANGMESST703","Copier/coller le lien ");
define("LANGMESST704","Indiquer le destinateur du message � transmettre.");
define("LANGMESST705","Message non envoy� ! \\n \\n Vous n'avez pas l'autorisation d'envoyer un message � cette personne.\\n\\n L'Equipe TRIADE. ");
define("LANGTMESS400","Votre demande a bien �t� pris en compte,");
define("LANGTMESS401","Veuillez consulter votre adresse email");
define("LANGTMESS402","Aucun compte pour cet email !!");
define("LANGTMESS403","merci de contacter votre administrateur en cliquant ");
define("LANGTMESS404","sur ce lien ");
define("LANGTMESS405","Contacter l'administrateur TRIADE ");
define("LANGTMESS406","V�rifier");
define("LANGTMESS407","V�rification / Check groupes");
define("LANGTMESS408","Email non valide !!");
define("LANGTMESS409","Merci d'indiquer un email valide.");
define("LANGTMESS410","Les emails <b>hotmail</b> ne sont pas reconnues par nos serveurs.");
define("LANGTMESS411","Merci d'indiquer une autre adresse email.");
define("LANGTMESS412","Nouveau R�pertoire");
define("LANGTMESS413","Message d�j� imprim�");
define("LANGTMESS414","Pi�ce jointe");
define("LANGTMESS415","Archiver dans");
define("LANGTMESS416","Boite de ");
define("LANGTMESS417","Boite de R�ception");
define("LANGTMESS418","Mode Classique");
define("LANGTMESS419","Messages envoy�es ");
define("LANGTMESS420","Vos r�pertoires ");
define("LANGTMESS421","via le mail ");
define("LANGTMESS422","via SMS ");
define("LANGTMESS423","via RSS ");
define("LANGTMESS424","Module lors de votre connexion");
define("LANGTMESS425","Module d'absenteisme");
define("LANGTMESS426","Liste d'une UE ( Modif / Suppr )");
define("LANGTMESS427","PDF EDT Enregistr�");
define("LANGTMESS428","L'Equipe Triade");
define("LANGTMESS429","Image EDT Enregistr�e");
define("LANGTMESS430","EDT Supprim�");
define("LANGTMESS431","Nom de structure d�j� utilis�");
define("LANGTMESS432","Exportation format");
define("LANGTMESS433","&nbsp;Total&nbsp;");
define("LANGTMESS434","colonnes");
define("LANGTMESS435","Tuteur de stage");
define("LANGTMESS436","Afficher Adresse");
define("LANGTMESS437","Tous les parents");
define("LANGTMESS438","Tous les ");
define("LANGTMESS439","Lister / Modification");
define("LANGTMESS440","ajouter");
define("LANGTMESS441","Rangement / Info.");
define("LANGTMESS442","par mois");
define("LANGTMESS443","Nb mois");
define("LANGTMESS444","Code comptabilit�");
define("LANGTMESS445","Universitaire");
define("LANGTMESS446","Editer le RIB");
define("LANGTMESS447","Donn�e d�j� enregistr�e");
define("LANGTMESS448","Site rattach�");
define("LANGTMESS449","D�finition compl�te");


define("LANGCIV0","M.");
define("LANGCIV1","Mme");
define("LANGCIV2","Mlle");
define("LANGCIV3","Ms");
define("LANGCIV4","Mr");
define("LANGCIV5","Mrs");
define("LANGCIV6","M. ou Mme");
define("LANGCIV7","Sr");
define("LANGCIV8","G�n�ral");
define("LANGCIV9","Colonel");
define("LANGCIV10","Lieutenant-Colonel");
define("LANGCIV11","Commandant");
define("LANGCIV12","Capitaine");
define("LANGCIV13","Lieutenant");
define("LANGCIV14","Sous-Lieutenant");
define("LANGCIV15","Aspirant");
define("LANGCIV16","Major");
define("LANGCIV17","Adjudant-Chef");
define("LANGCIV18","Adjudant");
define("LANGCIV19","Sergent-Chef");
define("LANGCIV20","Sergent");
define("LANGCIV21","Caporal-Chef");
define("LANGCIV22","Caporal");
define("LANGCIV23","Aviateur");
define("LANGCIV24","Dr");

define("LANGMESS391","Mode Classique");
define("LANGMESS392","Liste des destinataires");
define("LANGMESS393","Effacer liste"); // lg 262
define("LANGMESS394","S�lectionnez un fichier");
define("LANGMESS395","Liste des membres de la direction");
define("LANGMESS396","Visualiser / Modifier");
define("LANGMESS397","Liste de la Vie Scolaire");
define("LANGMESS398","D�sactiver compte");
define("LANGMESS399","Activer compte");
define("LANGMESS400","Permission");
define("LANGMESS401","Liste des comptes personnels ");
define("LANGMESS403","Liste Tuteur de stage");
define("LANGMESS404","Liste / Modifier");
define("LANGMESS405","M.");
define("LANGMESS406","Mme");
define("LANGTMESS450","Traduction autre langue");
define("LANGTMESS451","Actuellement le fichier import sert de r�f�rence � la cr�ation du certificat.");
define("LANGTMESS452","R�cup�rer");
define("LANGTMESS453","Certificat num�ro :");
define("LANGTMESS454","Ajouter une inscription :");
define("LANGTMESS455","Nouveau");
define("LANGTOUS","Tous");
define("LANGTMESS456","En attente");
define("LANGTMESS457","Accept�");
define("LANGTMESS458","R�fus�");
define("LANGTMESS459","D�cision");
define("LANGTMESS460","Transferer liste en classe");
define("LANGTMESS461","Destruction fiche(s)");
define("LANGTMESS462","Attention !, le r�glement doit �tre au format pdf et ne pas d�passer deux m�ga oct�.");
define("LANGTMESS463","Cette option permet aux enseignants, de valider le r�glement au moment de leur premiere connexion.");
define("LANGTMESS464","El�ve(s) au total.");
define("LANGTMESS465","Commentaire pour le");
define("LANGTMESS466","Afficher les sous-mati�res");
define("LANGTMESS467","Prise en compte note examen");
define("LANGTMESS468","Prise en compte coef � z�ro");
define("LANGTMESS469","Si le coefficient est � z�ro, les points sup�rieurs � 10 seront pris en compte.");
define("LANGTMESS470","Sp�cif");
define("LANGTMESS471","Etude de cas");
define("LANGTMESS472","Visu : Visualisation dans le bulletin");
define("LANGTMESS473","pour l'ann�e :");
define("LANGTMESS474","changer");
define("LANGTMESS475","Fichier Taille Max");
define("LANGTMESS476","Liste / Modifier un compte personnel");
define("LANGTMESS477","Liste / Modifier un tuteur de stage");

//--------------------list_classe.php
//--------------------modif_classe.php
define("LANGMESS407","Modification d'une classe");
define("LANGMESS408","Activer la classe");
define("LANGMESS409","D�sactiver la classe");
define("LANGMESS410","D�finition compl�te");
define("LANGMESS411","Site rattach�");
//--------------------affectation_creation.php
//-------------------publipostage.php
define("LANGMESS412","Type de vignette");
define("LANGMESS413","Type de membre");
//-------------------list_matiere.php
//-------------------modif_matiere.php
define("LANGMESS414","Type de membre");
define("LANGMESS415","Code mati�re");
define("LANGMESS416","Nom de la sous-mati�re");
define("LANGMESS417","Supprimer sous mati�re");
define("LANGMESS418","D�sactiver mati�re");
define("LANGMESS419","Activer mati�re");
//-------------------triadev1/circulaire_liste.php
define("LANGMESS420","R�f�rence");
//-------------------visu_retard_parent.php
//-------------------messagerie_envoi.php
define("LANGMESS421","Vous n'avez pas l'autorisation d'envoyer un message � cette personne.");
//-------------------information.php
define("LANGMESS422","Informations scolaires");
//-------------------parametrage.php
define("LANGMESS423","Module lors de votre connexion ");
define("LANGMESS424","Actualit�s");
define("LANGMESS425","Module d'absenteisme");
//-------------------retardprof.php
define("LANGMESS426","Indiquez des �l�ves en retard ou absent");
//-------------------retardprof2.php
define("LANGMESS427","Indiquer heure d'abs/rtd");
define("LANGMESS428","En ");
define("LANGMESS429","Horaire : ");


define("LANGTMESS478","Via code barre");
define("LANGTMESS479","Valider les pr�sents");
define("LANGTMESS480","Visa direction");
define("LANGTMESS481","Commentaires pour les ".INTITULEELEVES);

define("LANGTMESS482","ACTUALITES - TRIADE");
define("LANGTMESS483","non disponible");
define("LANGTMESS484","Vos r�pertoires");
define("LANGTMESS485","Messages aux d�l�gu�s");
define("LANGTMESS486","Modifier des circulaires");

define("LANGMESS430","L'ann�e compl�te");
define("LANGMESS431","Avec notes partiel Vatel ");
define("LANGMESS432","Type du bulletin");
define("LANGMESS433","Enregistrement par code barre");
define("LANGMESS434","Valider les pr�sents");
define("LANGMESS435","Courrier");
define("LANGMESS436","Relev�s sans abs, ni rtd");
define("LANGMESS437","Listing des absences");
define("LANGMESS438","Absences par semaine");
define("LANGMESS439","Imprimer absences / retards");
define("LANGMESS440","Liste des pr�sents");
define("LANGMESS441","Gestion abs/rtd via sconet");
define("LANGMESS442","Statistiques Abs / Rtd ");
define("LANGMESS443","Gestion des absences et retards d'un ".INTITULEELEVE);
define("LANGMESS444","Planifier&nbsp;");
define("LANGMESS445","&nbsp;Consulter&nbsp;/&nbsp;Modifier&nbsp;");
define("LANGMESS446","&nbsp;Supprimer&nbsp;");
define("LANGMESS447","Acc�der");
define("LANGMESS448","&nbsp;Convertir&nbsp;abs.&nbsp;");
define("LANGMESS449","Configuration");
define("LANGMESS450","Gestion alertes");
define("LANGMESS451","Configuration cr�neau horaire ");
define("LANGMESS452","Configuration  SMS ");
define("LANGMESS453","Cr�diter des SMS");

define("LANGTMESS487","Avec notes vie scolaire");
define("LANGTMESS488","Rattrapage non valid�s");

define("LANGTRONBI30","Visualisation Trombinoscope du personnel");
define("LANGTRONBI20","Modifier Trombinoscope du personnel");

define("LANGSEXEF","F");
define("LANGSEXEH","H");
define("LANGHOM","Homme");
define("LANGFEM","Femme");

define("LANGTMESS489","Dupliquer l'EDT");
define("LANGTMESS490","Dupliquer l'EDT d'une classe vers une autre");
define("LANGTMESS491","P�riode � copier");
define("LANGTMESS492","Import du personnel de direction : ");
define("LANGTMESS493","Import des comptes du personnel : ");
define("LANGTMESS494","Import des entreprises : ");
define("LANGTMESS495","Import Sp�cif. IPAC : ");
define("LANGTMESS496","Import des mati�res : ");
define("LANGTMESS497","Module d'importation de fichier : ");
define("LANGTMESS498","Module d'importation de fichier Excel ");
define("LANGTMESS499","Le fichier excel � transmettre DOIT contenir 4 champs");
define("LANGTMESS500","Exemple fichier xls");
define("LANGTMESS501","Nombre de mati�re ajout�e : ");
define("LANGTMESS502","Dates Trimestrielles");
define("LANGTMESS503","Votre acc�s est actuellement d�sactiv�.");
define("LANGTMESS504","Envoyer mot de passe par mail");
define("TITREACC1","parents");      // Info au niveau de la page d'accueil "Acc�s Parents"  
define("TITREACC2","Enseignants");  // Info au niveau de la page d'accueil "Acc�s Enseignants"  
define("TITREACC3","Vie scolaire"); // Info au niveau de la page d'accueil "Acc�s Vie scolaire"  
define("TITREACC4","Tuteur Stage"); // Info au niveau de la page d'accueil "Acc�s Tuteur Stage"  
define("TITREACC5","Personnels");   // Info au niveau de la page d'accueil "Acc�s Personnels"  
define("LANGTMESS505","Classe ant�rieures");
define("LANGTMESS506","Sp�cialisation");
define("LANGTMESS507","Sortie suppl�ment au titre");
define("LANGTMESS508","Configuration suppl�ment au titre");
define("LANGTMESS509","Gestion d'examen");
define("LANGTMESS510","Choix du document :");
define("LANGTMESS511","R�cup�rer le fichier ZIP Suppl�ments Titre");
define("LANGTMESS512","Niveau scolaire");
define("LANGTMESS513","Publipostage des soci�t�s ");
define("LANGTMESS514","Import des entreprises");
define("LANGTMESS515","Indemnit� de stage");
define("LANGTMESS516","Suivi des demandes de convention");
define("LANGTMESS517","Gestion suppl�ment au titre");
define("LANGTMESS518","Libell� :");
define("LANGTMESS519","Fichier");

define("LANGTMESS520","Nom du stage");
define("LANGTMESS521","En Entreprise le : ");
define("LANGTMESS522","Pays");
define("LANGTMESS523","Groupe h�telier");
define("LANGTMESS524","Nombre d'�toiles");
define("LANGTMESS525","Nombre de chambres");
define("LANGTMESS526","Site web");
define("LANGTMESS527","Affectation de plusieurs �tudiants � un stage");
define("LANGSTAGE100","Nom");
define("LANGSTAGE101","N� Stage");
define("LANGSTAGE102","Entreprise");
define("LANGSTAGE103","Service");
define("LANGSTAGE104","Indemnit�");
define("LANGSTAGE105","Log�");
define("LANGSTAGE106","Nourri");
define("LANGSTAGE107","Valider");
define("LANGSTAGE108","Stage personnalis�");
define("LANGSTAGE109","Pays");
define("LANGSTAGE110","Tuteur de stage");
define("LANGSTAGE111","Langue parl� durant le stage");
define("LANGSTAGE112","Intitul� du service");
define("LANGSTAGE113","Indemnit�s de stage");
define("LANGSTAGE114","Horaires journaliers");
define("LANGSTAGE115","Les conventions de stage");
define("LANGSTAGE116","Sortie des conventions group�es");

define("LANGTMESS528","Langue de la classe");
define("LANGTMESS529","Retour classe");
define("LANGTMESS530","R�cuperation des conventions de stage");


define("LANGVATEL1","D&eacute;connexion");
define("LANGVATEL2","Me connecter");
define("LANGVATEL3","Mot de passe oubli&eacute;");
define("LANGVATEL4","Ecris ton email");
define("LANGVATEL5","Ecris ton mot de passe");
define("LANGVATEL6","Semestre");
define("LANGVATEL7","Abs/Rtd/Sanction");
define("LANGVATEL8","Absences / Retards / Sanctions");
define("LANGVATEL9","Absences");
define("LANGVATEL10","Retards");
define("LANGVATEL11","Sanctions");
define("LANGVATEL12","Description des faits");
define("LANGVATEL13","<");
define("LANGVATEL14",">");
define("LANGVATEL15","Mois");
define("LANGVATEL16","R&eacute;initialiser votre mot de passe");
define("LANGVATEL17","Mot de passe oubli&eacute; ?");

define("LANGVATEL18","Acc&egrave;s Etudiant");
define("LANGVATEL19","Acc&egrave;s Enseignant");
define("LANGVATEL20","Acc&egrave;s Personnel");

define("LANGVATEL21","Ajouter");
define("LANGVATEL22","Modifier");
define("LANGVATEL23","Supprimer");
define("LANGVATEL24","Visualiser");
define("LANGVATEL25","Quoi de neuf ?");
define("LANGVATEL26","Notes");
define("LANGVATEL27","Statistiques de ce devoir");
define("LANGVATEL28","IMPOSSIBLE");
define("LANGVATEL29","Semestre déjà passé.");
define("LANGVATEL30","Ajouter élève");
define("LANGVATEL31","Ajouter une note à un élève pour ce devoir.");
define("LANGVATEL32","Retour sur la liste des devoirs");
define("LANGVATEL33","Emploi du temps");
define("LANGVATEL34","Absentéisme");
define("LANGVATEL35","absent(s) signé(s)");
define("LANGVATEL36","Calendrier");
define("LANGVATEL37","Problème d'enregistrement");
define("LANGVATEL38","Indiquer la date");

define("LANGMESSE01","Accès à votre compte SMS");
define("LANGMESSE02","Gestion des SMS"); 

?>
