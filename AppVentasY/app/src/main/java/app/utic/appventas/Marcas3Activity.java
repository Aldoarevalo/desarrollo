package app.utic.appventas;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.Toast;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.JsonObjectRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.example.appventas.R;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

public class Marcas3Activity extends AppCompatActivity {


    static String HOST = LoginActivity.HOST;
    String TABLA = "marca/";
    String ENLACE = HOST+TABLA;

    //referenciar elementos
    EditText txtCodigo, txtDescripcion;
    Button btnRegistrar, btnModificar, btnEliminar, btnBuscar;
    ProgressDialog progreso;
    ListView lista;
    RequestQueue request, requestQueue;
    JsonObjectRequest jsonObjectRequest;
    private Integer idEliminar;

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_marcas3);

        txtCodigo = (EditText) findViewById(R.id.txt_codigo);
        txtDescripcion= (EditText) findViewById(R.id.txt_descripcion);

        btnRegistrar= (Button) findViewById(R.id.btnRegistrar);
        btnModificar= (Button) findViewById(R.id.btnModificar);
        btnEliminar= (Button) findViewById(R.id.btnEliminar);
        btnBuscar= (Button) findViewById(R.id.btnBuscar);

        request= Volley.newRequestQueue(getApplicationContext());
        lista = (ListView) findViewById(R.id.listaMarcas);

        Cargarlista();
        btnEliminar.setEnabled(false);
        btnModificar.setEnabled(false);
        txtCodigo.setEnabled(false);

        lista.setOnItemClickListener(new AdapterView.OnItemClickListener() {
            @Override
            public void onItemClick(AdapterView<?> adapterView, View view, int i, long l) {
                String listItem = (String) lista.getItemAtPosition(i);

                idEliminar = Integer.parseInt(listItem.split(" - ")[0]);

                txtCodigo.setText(idEliminar.toString());
                Buscar();
            }
        });
    }




    public void registrarBtn(View View) {
        String descri = txtDescripcion.getText().toString();
        if(descri.isEmpty()){
           //txtDescripcion.setError("Codigo Obligatorio");
            Toast.makeText(getApplicationContext(), "El campo no puede estar vacio", Toast.LENGTH_LONG).show();
            txtDescripcion.requestFocus();
        } else {
        String URL = ENLACE+"insert.php?descripcion="+txtDescripcion.getText().toString();
        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject parentObject = new JSONObject(response);
                    if (parentObject.getString("CREATE").equals("OK")){
                        String cod = parentObject.getString("ID");
                        txtDescripcion.setText("");
                        Toast.makeText(Marcas3Activity.this, "Registro numero "+cod+" insertado", Toast.LENGTH_SHORT).show();
                        Cargarlista();

                    } else if (parentObject.getString("CREATE").equals("EXISTE")){
                        Toast.makeText(getApplicationContext(), "El Registro ya existe!!", Toast.LENGTH_SHORT).show();
                    }else {
                        Toast.makeText(getApplicationContext(), "Probable registro existente", Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    Toast.makeText(getApplicationContext(), "Error "+e.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), "Sin conexion a Internet", Toast.LENGTH_LONG).show();
            }
        });
        requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }
    }


    public void Modificar(View view) {
        final String URL = ENLACE+"update.php?codigo="+txtCodigo.getText().toString()+"&descripcion="+txtDescripcion.getText().toString();
        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                try {
                    JSONObject parentObject = new JSONObject(response);
                    if (parentObject.getString("CREATE").equals("OK")){
                        txtCodigo.setText("");
                        txtDescripcion.setText("");
                        Toast.makeText(Marcas3Activity.this, "Registro modificado con exito!!!", Toast.LENGTH_SHORT).show();
                        Cargarlista();

                    } else if (parentObject.getString("CREATE").equals("EXISTE")){
                        Toast.makeText(getApplicationContext(), "El Registro ya existe!!", Toast.LENGTH_SHORT).show();
                    }else {
                        Toast.makeText(getApplicationContext(), "ERROR AL INSERTAR", Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    Toast.makeText(getApplicationContext(), "Error "+e.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), URL, Toast.LENGTH_LONG).show();
            }
        });
        requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }


    public void Eliminar(View view) {
        AlertDialog.Builder builder = new AlertDialog.Builder(Marcas3Activity.this);
        builder.setMessage("??Desea Eliminar este registro?").setPositiveButton("Si", dialogClickListener)
                .setNegativeButton("No", dialogClickListener).show();
    }



    DialogInterface.OnClickListener dialogClickListener = new DialogInterface.OnClickListener() {
        @Override
        public void onClick(DialogInterface dialog, int which) {
            switch (which){
                case DialogInterface.BUTTON_POSITIVE:
                    String URL = ENLACE+"delete.php?codigo="+txtCodigo.getText().toString();
                    StringRequest stringRequest = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            try {
                                JSONObject parentObject = new JSONObject(response);
                                if (parentObject.getString("CREATE").equals("OK")){
                                    txtCodigo.setText("");
                                    txtDescripcion.setText("");
                                    Toast.makeText(Marcas3Activity.this, "Registro eliminado con exito!!!", Toast.LENGTH_SHORT).show();
                                    Cargarlista();

                                } else if (parentObject.getString("operacion").equals("unico")){
                                    Toast.makeText(getApplicationContext(), "El Registro ya existe!!", Toast.LENGTH_SHORT).show();
                                }else {
                                    Toast.makeText(getApplicationContext(), "ERROR AL INSERTAR", Toast.LENGTH_LONG).show();
                                }
                            } catch (JSONException e) {
                                Toast.makeText(getApplicationContext(), "Error "+e.getMessage(), Toast.LENGTH_SHORT).show();
                            }
                        }
                    }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Toast.makeText(getApplicationContext(), "Sin conexion a Internet", Toast.LENGTH_LONG).show();
                        }
                    });
                    requestQueue = Volley.newRequestQueue(Marcas3Activity.this);
                    requestQueue.add(stringRequest);
                    Cancelar();
                    break;

                case DialogInterface.BUTTON_NEGATIVE:
                        Cancelar();
                    break;
            }
        }
    };



    public void Buscar() {
        String URL = ENLACE+"search.php?codigo="+txtCodigo.getText().toString();
        StringRequest stringRequest = new StringRequest(Request.Method.POST, URL, new Response.Listener<String>() {

            @Override
            public void onResponse(String response) {
                try {
                    JSONObject parentObject = new JSONObject(response);
                    if (parentObject.getString("CREATE").equals("OK")){
                        //int descri = parentObject.getInt("des");
                        String descri = parentObject.getString("des");
                        txtDescripcion.setText(descri);
                        //txtDescripcion.setText("");
                        //Toast.makeText(Marcas3Activity.this, "Recuperado", Toast.LENGTH_SHORT).show();
                        Cargarlista();
                        btnRegistrar.setEnabled(false);
                        btnEliminar.setEnabled(true);
                        btnModificar.setEnabled(true);
                        txtDescripcion.requestFocus();
                        txtDescripcion.setSelection(txtDescripcion.getText().toString().length());


                    } else if (parentObject.getString("CREATE").equals("EXISTE")){
                        Toast.makeText(getApplicationContext(), "El Registro ya existe!!", Toast.LENGTH_SHORT).show();
                    }else {
                        Toast.makeText(getApplicationContext(), "No Existe", Toast.LENGTH_LONG).show();
                    }
                } catch (JSONException e) {
                    Toast.makeText(getApplicationContext(), "No Existe", Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), "Sin conexion a Internet", Toast.LENGTH_LONG).show();
            }
        });
        requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(stringRequest);
    }

    @Override
    public void onBackPressed (){
        finish();
    }


    private void Cargarlista() {
        final ArrayAdapter<String> adapter = new ArrayAdapter<String>(Marcas3Activity.this,R.layout.support_simple_spinner_dropdown_item);
        String URL=ENLACE+"select.php";

        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(URL, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                JSONObject jsonObject = null;
                for (int i = 0; i < response.length(); i++) {
                    try {
                        jsonObject = response.getJSONObject(i);
                        String codigo = jsonObject.getString("cod");
                        String descripcion = jsonObject.getString("des");

                        adapter.add(codigo+" - "+descripcion);

                    } catch (JSONException e) {
                        Toast.makeText(getApplicationContext(), e.getMessage(), Toast.LENGTH_LONG).show();
                    }
                }lista.setAdapter(adapter);
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), "Sin conexion a Internet", Toast.LENGTH_LONG).show();
            }
        }
        );
        requestQueue = Volley.newRequestQueue(this);
        requestQueue.add(jsonArrayRequest);
    }

    public void CancelarBoton(View view) {
        txtCodigo.setText("");
        txtDescripcion.setText("");
        btnRegistrar.setEnabled(true);
        btnEliminar.setEnabled(false);
        btnModificar.setEnabled(false);
    }

    public void Cancelar() {
        txtCodigo.setText("");
        txtDescripcion.setText("");
        btnRegistrar.setEnabled(true);
        btnEliminar.setEnabled(false);
        btnModificar.setEnabled(false);
    }
}
