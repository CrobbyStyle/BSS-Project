package ec.edu.espol.fiec.bss;
import android.graphics.Color;
import android.view.View;
import android.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.Button;
import android.content.DialogInterface;

public class MainActivity extends AppCompatActivity  {
    boolean pressed = false;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

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




}
