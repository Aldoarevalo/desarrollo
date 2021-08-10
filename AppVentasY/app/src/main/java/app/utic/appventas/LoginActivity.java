package app.utic.appventas;

import android.content.Intent;
import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;
import android.view.WindowManager;
import android.view.inputmethod.InputMethodManager;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.appventas.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class LoginActivity extends AppCompatActivity {


    //colocar la ip del equipo cmd->ipconfig
    public static String HOST = "http://192.168.0.3/appventas/";
    //public static String HOST = "";
    Button btnIngresar;
    EditText txtUsu,txtPass;
    RequestQueue request, requestQueue;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);
        txtUsu=(EditText)findViewById(R.id.txtusu);
        txtPass=(EditText)findViewById(R.id.txtpass);
        btnIngresar=(Button)findViewById(R.id.btnIngresar);
        //btnIngresar.setOnClickListener(this);
        txtUsu.requestFocus();
        getWindow().setSoftInputMode(WindowManager.LayoutParams.SOFT_INPUT_STATE_VISIBLE);
    }



    public void acceder(View View) {

        String URL=HOST+"login.php?usuario="+txtUsu.getText().toString()+"&clave="+txtPass.getText().toString();

        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject parentObject = new JSONObject(response);
                    if (parentObject.getString("CREATE").equals("OK")){
                        String nom = parentObject.getString("nom");
                        String ape = parentObject.getString("ape");
                        String cod = parentObject.getString("cod");
                        String usu = nom+" "+ape;


                        Intent i=new Intent(getApplicationContext(),MainActivity.class);
                        i.putExtra("usu",cod);
                        startActivity(i);


                    } else if (parentObject.getString("CREATE").equals("EXISTE")){
                        Toast.makeText(getApplicationContext(), "El Registro ya existe!!", Toast.LENGTH_SHORT).show();
                    }else {
                        Toast.makeText(getApplicationContext(), "Datos Incorrectos", Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    Toast.makeText(getApplicationContext(), "Error "+e.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), "Sin conexion a Internet"+error.getMessage(), Toast.LENGTH_LONG).show();
            }
        });
        requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }

    public void salir(View view) {
        finish();
    }
}
