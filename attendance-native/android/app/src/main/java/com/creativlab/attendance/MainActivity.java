package com.creativlab.attendance;

import android.os.Bundle;
import com.getcapacitor.BridgeActivity;

public class MainActivity extends BridgeActivity {
    @Override
    public void onCreate(Bundle savedInstanceState) {
        registerPlugin(WifiInfoPlugin.class);
        registerPlugin(BackgroundServicePlugin.class);
        super.onCreate(savedInstanceState);
    }
}
