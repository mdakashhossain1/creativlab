// FILE DESTINATION (after npx cap add android):
// android/app/src/main/java/com/creativlab/attendance/BootReceiver.java
//
// AndroidManifest.xml addition (inside <application>):
//   <receiver
//       android:name=".BootReceiver"
//       android:enabled="true"
//       android:exported="true">
//     <intent-filter>
//       <action android:name="android.intent.action.BOOT_COMPLETED"/>
//       <action android:name="android.intent.action.MY_PACKAGE_REPLACED"/>
//     </intent-filter>
//   </receiver>

package com.creativlab.attendance;

import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.os.Build;

public class BootReceiver extends BroadcastReceiver {
    @Override
    public void onReceive(Context context, Intent intent) {
        String action = intent.getAction();
        if (Intent.ACTION_BOOT_COMPLETED.equals(action) ||
            Intent.ACTION_MY_PACKAGE_REPLACED.equals(action)) {
            Intent service = new Intent(context, AttendanceService.class);
            if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.O) {
                context.startForegroundService(service);
            } else {
                context.startService(service);
            }
        }
    }
}
