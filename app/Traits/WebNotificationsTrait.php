<?php

namespace App\Traits;

use App\Models\User;
use App\Notifications\NewNotification;

trait WebNotificationsTrait
{
  protected function test(User $user)
  {
    $title        = json_encode(['ar' => "مها الغبية", 'en' => "Maha El8abya"]);
    $date         = \Carbon\Carbon::now()->diffForHumans();
    $icon         = '<svg id="Icon_ionic-ios-notifications-outline" data-name="Icon ionic-ios-notifications-outline" xmlns="http://www.w3.org/2000/svg" width="14.381" height="18" viewBox="0 0 14.381 18">
            <path id="Path_19090" data-name="Path 19090" d="M18.328,28.336a.583.583,0,0,0-.571.459,1.127,1.127,0,0,1-.225.49.85.85,0,0,1-.724.265.864.864,0,0,1-.724-.265,1.127,1.127,0,0,1-.225-.49.583.583,0,0,0-.571-.459h0a.587.587,0,0,0-.571.715,2.01,2.01,0,0,0,2.092,1.669A2.006,2.006,0,0,0,18.9,29.051a.589.589,0,0,0-.571-.715Z" transform="translate(-9.63 -12.72)" fill="#339696"/>
            <path id="Path_19091" data-name="Path 19091" d="M20.975,17.261c-.693-.913-2.056-1.449-2.056-5.538,0-4.2-1.854-5.885-3.581-6.289-.162-.04-.279-.094-.279-.265v-.13A1.1,1.1,0,0,0,13.98,3.93h-.027a1.1,1.1,0,0,0-1.08,1.107v.13c0,.166-.117.225-.279.265-1.732.409-3.581,2.092-3.581,6.289,0,4.089-1.363,4.62-2.056,5.538a.893.893,0,0,0,.715,1.431h12.6A.894.894,0,0,0,20.975,17.261Zm-1.755.261H8.729a.2.2,0,0,1-.148-.328,5.45,5.45,0,0,0,.945-1.5,10.2,10.2,0,0,0,.643-3.968,6.9,6.9,0,0,1,.94-3.905A2.887,2.887,0,0,1,12.85,6.576a1.577,1.577,0,0,0,.837-.472.356.356,0,0,1,.535-.009,1.63,1.63,0,0,0,.846.481,2.887,2.887,0,0,1,1.741,1.242,6.9,6.9,0,0,1,.94,3.905,10.2,10.2,0,0,0,.643,3.968,5.512,5.512,0,0,0,.967,1.525A.186.186,0,0,1,19.221,17.522Z" transform="translate(-6.775 -3.93)" fill="#339696"/>
          </svg>';
    $color        = "primary";
    $url          = "/rewards";
    $notification = new NewNotification($title, 'WithdrawRequest', 'مها الغبية', $date, $icon, $color, $url);
    $title        = json_decode($title);
    $lang         = app()->getLocale();

    sendFirebaseNotification($title->$lang, 'WithdrawRequest', $user->fcm_token);
    $user->notify($notification);
  }

  protected static function newExpiredLessMinuteNotification($user)
  {
     
    $userFcmToken = $user->fcm_token;
    
    $title        = json_encode(['ar' => "تبقى عدة دقائق لإنتهاء الركنة", 'en' => "There are several minutes left until the parking ends"]);
    $description  = json_encode(['ar' => "هناك عدة دقائق متبقية لإنتهاء الركنة", 'en' => "There are several minutes left until the parking ends"]);
    $date         = \Carbon\Carbon::now()->diffForHumans();
    $type         = 'pending';
    $notification = new NewNotification($title, $description, $date, $type);
    $title        = json_decode($title);
    $lang         = app()->getLocale();
  
    if(!is_null($userFcmToken))
    sendFirebaseNotification($title->$lang, $type, $userFcmToken );
    $user->notify($notification);

    // foreach ($users as $user)
    // {
    //     $user->notify($notification);
    // }
  }
  protected static function newExpiredNowNotification($user)
  {
    $userFcmToken = $user->fcm_token;
    
    
    $title        = json_encode(['ar' => "تم الانتهاء من وقت الركنة ", 'en' => "Parking time ended"]);
    $description  = json_encode(['ar' => "تم الانتهاء من وقت الركنة", 'en' => "Parking time ended"]);
    $date         = \Carbon\Carbon::now()->diffForHumans();
    $type         = 'expired';
    $notification = new NewNotification($title, $description, $date, $type);
    $title        = json_decode($title);
    $lang         = app()->getLocale();
    if(!is_null($userFcmToken))

      sendFirebaseNotification($title->$lang, $type,$userFcmToken);
    $user->notify($notification);
  }
  protected static function newUserComplaintNotification($admins)
  {

    $titleAr       = "تم استلام شكوى او اقتراح جديدة";
    $titleEn       = "A new complaint or suggestion has been received";
    $descriptionAr = "تم استلام شكوى او اقتراح جديدة من المستخدم. يرجى مراجعتها واتخاذ الإجراءات اللازمة";
    $descriptionEn = "A new complaint or suggestion has been received from the user. Please review it and take necessary action";
    $icon          = '<svg id="Icon_ionic-ios-notifications-outline" data-name="Icon ionic-ios-notifications-outline" xmlns="http://www.w3.org/2000/svg" width="14.381" height="18" viewBox="0 0 14.381 18">
            <path id="Path_19090" data-name="Path 19090" d="M18.328,28.336a.583.583,0,0,0-.571.459,1.127,1.127,0,0,1-.225.49.85.85,0,0,1-.724.265.864.864,0,0,1-.724-.265,1.127,1.127,0,0,1-.225-.49.583.583,0,0,0-.571-.459h0a.587.587,0,0,0-.571.715,2.01,2.01,0,0,0,2.092,1.669A2.006,2.006,0,0,0,18.9,29.051a.589.589,0,0,0-.571-.715Z" transform="translate(-9.63 -12.72)" fill="#339696"/>
            <path id="Path_19091" data-name="Path 19091" d="M20.975,17.261c-.693-.913-2.056-1.449-2.056-5.538,0-4.2-1.854-5.885-3.581-6.289-.162-.04-.279-.094-.279-.265v-.13A1.1,1.1,0,0,0,13.98,3.93h-.027a1.1,1.1,0,0,0-1.08,1.107v.13c0,.166-.117.225-.279.265-1.732.409-3.581,2.092-3.581,6.289,0,4.089-1.363,4.62-2.056,5.538a.893.893,0,0,0,.715,1.431h12.6A.894.894,0,0,0,20.975,17.261Zm-1.755.261H8.729a.2.2,0,0,1-.148-.328,5.45,5.45,0,0,0,.945-1.5,10.2,10.2,0,0,0,.643-3.968,6.9,6.9,0,0,1,.94-3.905A2.887,2.887,0,0,1,12.85,6.576a1.577,1.577,0,0,0,.837-.472.356.356,0,0,1,.535-.009,1.63,1.63,0,0,0,.846.481,2.887,2.887,0,0,1,1.741,1.242,6.9,6.9,0,0,1,.94,3.905,10.2,10.2,0,0,0,.643,3.968,5.512,5.512,0,0,0,.967,1.525A.186.186,0,0,1,19.221,17.522Z" transform="translate(-6.775 -3.93)" fill="#339696"/>
          </svg>';
    $color         = "primary";
    storeAndPushNotificationAdmin($titleAr, $titleEn, $descriptionAr, $descriptionEn, $icon, $color, route('dashboard.complaints-suggestions.index'), $admins);
  }
  protected static function newObserverComplaintNotification($clients, $orderId)
  {

    $titleAr       = "تم استلام شكوى جديدة";
    $titleEn       = "A new complaint has been received";
    $descriptionAr = "تم استلام شكوى جديدة من المراقب. يرجى مراجعتها واتخاذ الإجراءات اللازمة";
    $descriptionEn = "A new complaint has been received from the supervisor. Please review it and take necessary action";
    $icon          = '<svg id="Icon_ionic-ios-notifications-outline" data-name="Icon ionic-ios-notifications-outline" xmlns="http://www.w3.org/2000/svg" width="14.381" height="18" viewBox="0 0 14.381 18">
            <path id="Path_19090" data-name="Path 19090" d="M18.328,28.336a.583.583,0,0,0-.571.459,1.127,1.127,0,0,1-.225.49.85.85,0,0,1-.724.265.864.864,0,0,1-.724-.265,1.127,1.127,0,0,1-.225-.49.583.583,0,0,0-.571-.459h0a.587.587,0,0,0-.571.715,2.01,2.01,0,0,0,2.092,1.669A2.006,2.006,0,0,0,18.9,29.051a.589.589,0,0,0-.571-.715Z" transform="translate(-9.63 -12.72)" fill="#339696"/>
            <path id="Path_19091" data-name="Path 19091" d="M20.975,17.261c-.693-.913-2.056-1.449-2.056-5.538,0-4.2-1.854-5.885-3.581-6.289-.162-.04-.279-.094-.279-.265v-.13A1.1,1.1,0,0,0,13.98,3.93h-.027a1.1,1.1,0,0,0-1.08,1.107v.13c0,.166-.117.225-.279.265-1.732.409-3.581,2.092-3.581,6.289,0,4.089-1.363,4.62-2.056,5.538a.893.893,0,0,0,.715,1.431h12.6A.894.894,0,0,0,20.975,17.261Zm-1.755.261H8.729a.2.2,0,0,1-.148-.328,5.45,5.45,0,0,0,.945-1.5,10.2,10.2,0,0,0,.643-3.968,6.9,6.9,0,0,1,.94-3.905A2.887,2.887,0,0,1,12.85,6.576a1.577,1.577,0,0,0,.837-.472.356.356,0,0,1,.535-.009,1.63,1.63,0,0,0,.846.481,2.887,2.887,0,0,1,1.741,1.242,6.9,6.9,0,0,1,.94,3.905,10.2,10.2,0,0,0,.643,3.968,5.512,5.512,0,0,0,.967,1.525A.186.186,0,0,1,19.221,17.522Z" transform="translate(-6.775 -3.93)" fill="#339696"/>
          </svg>';
    $color         = "primary";
    storeAndPushNotificationAdmin($titleAr, $titleEn, $descriptionAr, $descriptionEn, $icon, $color, route('dashboard.orders.show', $orderId), $clients);
  }
  protected static function newObserverAttendNotification($observer)
  {
    $titleAr       = "تسجيل دخول مراقب خارج الجراج";
    $titleEn       = "Observer check-in outside the garage";
    $descriptionAr = "تسجيل دخول مراقب خارج الجراج. يرجى التحقق من الحالة والتأكد من الامتثال للإجراءات";
    $descriptionEn = "Observer check-in outside the garage. Please check the status and ensure compliance with procedures";
    $icon          = '<svg id="Icon_ionic-ios-notifications-outline" data-name="Icon ionic-ios-notifications-outline" xmlns="http://www.w3.org/2000/svg" width="14.381" height="18" viewBox="0 0 14.381 18">
            <path id="Path_19090" data-name="Path 19090" d="M18.328,28.336a.583.583,0,0,0-.571.459,1.127,1.127,0,0,1-.225.49.85.85,0,0,1-.724.265.864.864,0,0,1-.724-.265,1.127,1.127,0,0,1-.225-.49.583.583,0,0,0-.571-.459h0a.587.587,0,0,0-.571.715,2.01,2.01,0,0,0,2.092,1.669A2.006,2.006,0,0,0,18.9,29.051a.589.589,0,0,0-.571-.715Z" transform="translate(-9.63 -12.72)" fill="#339696"/>
            <path id="Path_19091" data-name="Path 19091" d="M20.975,17.261c-.693-.913-2.056-1.449-2.056-5.538,0-4.2-1.854-5.885-3.581-6.289-.162-.04-.279-.094-.279-.265v-.13A1.1,1.1,0,0,0,13.98,3.93h-.027a1.1,1.1,0,0,0-1.08,1.107v.13c0,.166-.117.225-.279.265-1.732.409-3.581,2.092-3.581,6.289,0,4.089-1.363,4.62-2.056,5.538a.893.893,0,0,0,.715,1.431h12.6A.894.894,0,0,0,20.975,17.261Zm-1.755.261H8.729a.2.2,0,0,1-.148-.328,5.45,5.45,0,0,0,.945-1.5,10.2,10.2,0,0,0,.643-3.968,6.9,6.9,0,0,1,.94-3.905A2.887,2.887,0,0,1,12.85,6.576a1.577,1.577,0,0,0,.837-.472.356.356,0,0,1,.535-.009,1.63,1.63,0,0,0,.846.481,2.887,2.887,0,0,1,1.741,1.242,6.9,6.9,0,0,1,.94,3.905,10.2,10.2,0,0,0,.643,3.968,5.512,5.512,0,0,0,.967,1.525A.186.186,0,0,1,19.221,17.522Z" transform="translate(-6.775 -3.93)" fill="#339696"/>
          </svg>';
    $color         = "danger";
    storeAndPushNotificationAdmin($titleAr, $titleEn, $descriptionAr, $descriptionEn, $icon, $color, route('dashboard.observers.show', $observer->id), $observer->garage->admins);
  }
  protected static function newObserverCheckoutAttendNotification($observer)
  {
    $titleAr       = "تسجيل خروج مراقب خارج الجراج";
    $titleEn       = "Observer check outside the garage";
    $descriptionAr = "تسجيل خروج مراقب خارج الجراج. يرجى التحقق من الحالة والتأكد من الامتثال للإجراءات";
    $descriptionEn = "Observer check outside the garage. Please check the status and ensure compliance with procedures";
    $icon          = '<svg id="Icon_ionic-ios-notifications-outline" data-name="Icon ionic-ios-notifications-outline" xmlns="http://www.w3.org/2000/svg" width="14.381" height="18" viewBox="0 0 14.381 18">
            <path id="Path_19090" data-name="Path 19090" d="M18.328,28.336a.583.583,0,0,0-.571.459,1.127,1.127,0,0,1-.225.49.85.85,0,0,1-.724.265.864.864,0,0,1-.724-.265,1.127,1.127,0,0,1-.225-.49.583.583,0,0,0-.571-.459h0a.587.587,0,0,0-.571.715,2.01,2.01,0,0,0,2.092,1.669A2.006,2.006,0,0,0,18.9,29.051a.589.589,0,0,0-.571-.715Z" transform="translate(-9.63 -12.72)" fill="#339696"/>
            <path id="Path_19091" data-name="Path 19091" d="M20.975,17.261c-.693-.913-2.056-1.449-2.056-5.538,0-4.2-1.854-5.885-3.581-6.289-.162-.04-.279-.094-.279-.265v-.13A1.1,1.1,0,0,0,13.98,3.93h-.027a1.1,1.1,0,0,0-1.08,1.107v.13c0,.166-.117.225-.279.265-1.732.409-3.581,2.092-3.581,6.289,0,4.089-1.363,4.62-2.056,5.538a.893.893,0,0,0,.715,1.431h12.6A.894.894,0,0,0,20.975,17.261Zm-1.755.261H8.729a.2.2,0,0,1-.148-.328,5.45,5.45,0,0,0,.945-1.5,10.2,10.2,0,0,0,.643-3.968,6.9,6.9,0,0,1,.94-3.905A2.887,2.887,0,0,1,12.85,6.576a1.577,1.577,0,0,0,.837-.472.356.356,0,0,1,.535-.009,1.63,1.63,0,0,0,.846.481,2.887,2.887,0,0,1,1.741,1.242,6.9,6.9,0,0,1,.94,3.905,10.2,10.2,0,0,0,.643,3.968,5.512,5.512,0,0,0,.967,1.525A.186.186,0,0,1,19.221,17.522Z" transform="translate(-6.775 -3.93)" fill="#339696"/>
          </svg>';
    $color         = "danger";
    storeAndPushNotificationAdmin($titleAr, $titleEn, $descriptionAr, $descriptionEn, $icon, $color, route('dashboard.observers.show', $observer->id), $observer->garage->admins);
  }

  protected static function newCollectedNotification($admins, $from, $to)
  {
    $titleAr       = "تم جمع الطلب";
    $titleEn       = "Order collected";
    $descriptionAr = "تم جمع الطلب من تاريخ  $from إلى $to";
    $descriptionEn = "Order collected from $from to $to";
    $icon          = '<svg id="Icon_ionic-ios-notifications-outline" data-name="Icon ionic-ios-notifications-outline" xmlns="http://www.w3.org/2000/svg" width="14.381" height="18" viewBox="0 0 14.381 18">
            <path id="Path_19090" data-name="Path 19090" d="M18.328,28.336a.583.583,0,0,0-.571.459,1.127,1.127,0,0,1-.225.49.85.85,0,0,1-.724.265.864.864,0,0,1-.724-.265,1.127,1.127,0,0,1-.225-.49.583.583,0,0,0-.571-.459h0a.587.587,0,0,0-.571.715,2.01,2.01,0,0,0,2.092,1.669A2.006,2.006,0,0,0,18.9,29.051a.589.589,0,0,0-.571-.715Z" transform="translate(-9.63 -12.72)" fill="#339696"/>
            <path id="Path_19091" data-name="Path 19091" d="M20.975,17.261c-.693-.913-2.056-1.449-2.056-5.538,0-4.2-1.854-5.885-3.581-6.289-.162-.04-.279-.094-.279-.265v-.13A1.1,1.1,0,0,0,13.98,3.93h-.027a1.1,1.1,0,0,0-1.08,1.107v.13c0,.166-.117.225-.279.265-1.732.409-3.581,2.092-3.581,6.289,0,4.089-1.363,4.62-2.056,5.538a.893.893,0,0,0,.715,1.431h12.6A.894.894,0,0,0,20.975,17.261Zm-1.755.261H8.729a.2.2,0,0,1-.148-.328,5.45,5.45,0,0,0,.945-1.5,10.2,10.2,0,0,0,.643-3.968,6.9,6.9,0,0,1,.94-3.905A2.887,2.887,0,0,1,12.85,6.576a1.577,1.577,0,0,0,.837-.472.356.356,0,0,1,.535-.009,1.63,1.63,0,0,0,.846.481,2.887,2.887,0,0,1,1.741,1.242,6.9,6.9,0,0,1,.94,3.905,10.2,10.2,0,0,0,.643,3.968,5.512,5.512,0,0,0,.967,1.525A.186.186,0,0,1,19.221,17.522Z" transform="translate(-6.775 -3.93)" fill="#339696"/>
          </svg>';
    $color         = "primary";
    storeAndPushNotificationAdmin($titleAr, $titleEn, $descriptionAr, $descriptionEn, $icon, $color, route('dashboard.reports.sales-reports'), $admins);
  }
}
