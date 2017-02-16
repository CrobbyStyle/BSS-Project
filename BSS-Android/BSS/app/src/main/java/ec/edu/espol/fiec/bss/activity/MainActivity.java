package ec.edu.espol.fiec.bss.activity;


import android.app.AlertDialog;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.content.BroadcastReceiver;
import android.content.Context;
import android.content.Intent;
import android.content.IntentFilter;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v4.content.LocalBroadcastManager;
import android.support.v7.app.AppCompatActivity;
import android.text.TextUtils;
import android.util.Log;
import android.widget.TextView;
import android.widget.Toast;
import com.google.firebase.messaging.FirebaseMessaging;
import com.google.firebase.messaging.RemoteMessage;
import java.util.*;
import ec.edu.espol.fiec.bss.R;
import ec.edu.espol.fiec.bss.app.Config;
import ec.edu.espol.fiec.bss.util.NotificationUtils;
import android.os.CountDownTimer;

public class MainActivity extends AppCompatActivity  {
    private static final String TAG = MainActivity.class.getSimpleName();
    private BroadcastReceiver mRegistrationBroadcastReceiver;
    private TextView txtRegId, txtMessage;
    public int bandera = 1;

    boolean pressed = false;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        txtRegId = (TextView) findViewById(R.id.txt_reg_id);
        txtMessage = (TextView) findViewById(R.id.txt_push_message);

        mRegistrationBroadcastReceiver = new BroadcastReceiver() {
            @Override
            public void onReceive(Context context, Intent intent) {

                // checking for type intent filter
                if (intent.getAction().equals(Config.REGISTRATION_COMPLETE)) {
                    // gcm successfully registered
                    // now subscribe to `global` topic to receive app wide notifications
                    FirebaseMessaging.getInstance().subscribeToTopic(Config.TOPIC_GLOBAL);

                    displayFirebaseRegId();

                } else if (intent.getAction().equals(Config.PUSH_NOTIFICATION)) {
                    // new push notification is received
                    if(pressed==true) {

                        String message = intent.getStringExtra("message");
                        Toast.makeText(getApplicationContext(), "Push notification: " + message, Toast.LENGTH_LONG).show();
                        //txtMessage.setText(message);
                        if(bandera==1) {
                            displayTemp();
                        }

                    }

                }
            }
        };


        displayFirebaseRegId();


        final AlertDialog alert = new AlertDialog.Builder(this).create();
        alert.setTitle("CONECCION A BSS");
        alert.setMessage("Usted se conecto al sistema BSS, recibirá alerta cuando exista un receso");




        final Button boton = (Button) findViewById(R.id.button5);
        boton.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View view) {

                if(pressed==false){
                    boton.setBackgroundResource(R.drawable.mybutton3);
                    boton.setText("DESCONECTARSE");
                    boton.invalidate();
                    pressed=true;
                    alert.show();
                }
                else{
                    boton.setBackgroundResource(R.drawable.mybutton);
                    boton.setText("CONECTARSE");
                    boton.invalidate();
                    pressed=false;

                }
            }
        });


    }
    // Fetches reg id from shared preferences
    // and displays on the screen
    private void displayFirebaseRegId() {
        SharedPreferences pref = getApplicationContext().getSharedPreferences(Config.SHARED_PREF, 0);
        String regId = pref.getString("regId", null);

        Log.e(TAG, "Firebase reg id: " + regId);

       /* if (!TextUtils.isEmpty(regId))
            txtRegId.setText("Firebase Reg Id: " + regId);
        else
           txtRegId.setText("Firebase Reg Id is not received yet!");*/


    }



    private void displayTemp(){
        final AlertDialog tempo = new AlertDialog.Builder(this).create();
        int tiempoS=70000;

        new CountDownTimer(tiempoS, 1000) {

            public void onTick(long millisUntilFinished) {
                tempo.setTitle("ES HORA DE UN BREAK");
                long seconds = millisUntilFinished/1000 % 60;
                long minutes = (millisUntilFinished/1000 / 60 )%60;
                tempo.setMessage("TIEMPO DE BREAK: \n "+minutes+ " MINUTOS " +seconds+" SEGUNDOS RESTANTES");
                tempo.show();
                bandera=0;
            }

            public void onFinish() {
                tempo.setTitle("SE ACABO EL BREAK");
                tempo.setMessage("HORA DE VOLVER A TRABAJAR!");
                tempo.show();
                bandera=1;
            }
        }.start();

    }

    @Override
    protected void onResume() {
        super.onResume();

        // register GCM registration complete receiver
        LocalBroadcastManager.getInstance(this).registerReceiver(mRegistrationBroadcastReceiver,
                new IntentFilter(Config.REGISTRATION_COMPLETE));

        // register new push message receiver
        // by doing this, the activity will be notified each time a new message arrives
        LocalBroadcastManager.getInstance(this).registerReceiver(mRegistrationBroadcastReceiver,
                new IntentFilter(Config.PUSH_NOTIFICATION));

        // clear the notification area when the app is opened
        NotificationUtils.clearNotifications(getApplicationContext());
    }

    @Override
    protected void onPause() {
        LocalBroadcastManager.getInstance(this).unregisterReceiver(mRegistrationBroadcastReceiver);
        super.onPause();
    }

    @Override
    protected void onDestroy() {
        LocalBroadcastManager.getInstance(this).unregisterReceiver(mRegistrationBroadcastReceiver);
        super.onPause();
    }

    @Override
    public void onBackPressed() {
        moveTaskToBack(true);
    }


    public void onMessageReceived(RemoteMessage remoteMessage) {
        Map<String, String> data = remoteMessage.getData();
        String myCustomKey = data.get("my_custom_key");



        // Manage data
    }

}
