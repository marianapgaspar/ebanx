<?php
namespace App\Trigger\Migration;

use App\Trigger\Models\Triggers;
use System\Migration\Interfaces\IMigration;

class PopulateTriggers implements IMigration{
    public function up():string{
        if (!Triggers::instance()->getById(1)->id){
            $model = Triggers::instance()->getById(1);
            $model->trigger_class = 'recuperar_senha';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHA+UGFyYSByZWRlZmluaXIgc3VhIHNlbmhhLCBwb3IgZmF2b3IgZW50cmUgbm8gbGluayBhIHNlZ3VpciBlIGNhZGFzdHJlIHVtYSBub3ZhIHNlbmhhLjwvcD48cD48YSBocmVmPSJodHRwOi8vbm92YV9tb3RvcmVzLmxvY2FsL3VzZXJzL2ZvcmdvdC97aGFzaH0iIHRhcmdldD0iX2JsYW5rIj5SZWN1cGVyYcOnw6NvIGRlIHNlbmhhPC9hPjxicj48L3A+DQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAg","email_copys":[["users_groups"],["Desenvolvedores"]],"email_config":"1","email_subject":"Recupera\u00e7\u00e3o de senha"}';
            $model->save();
        }
        if (!Triggers::instance()->getById(2)->id){
            $model = Triggers::instance()->getById(2);
            $model->trigger_class = 'concluir_emitente_financeiro';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHA+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij5DbGllbnRlIGluc2VyaWRvIG5vIHBvcnRhbC4gQWd1YXJkYW5kbyBhcHJvdmHDp8OjbyBkbyBmaW5hbmNlaXJvLjwvc3Bhbj48L3A+PHA+PGEgaHJlZj0iaHR0cDovL25vdmFfbW90b3Jlcy5sb2NhbC9FbWl0ZW50ZS9mb3JtL3tjb2RfcG9ydGFsfSIgdGFyZ2V0PSJfYmxhbmsiPkxpbmsgZG8gZW1pdGVudGU8L2E+PC9wPjxwPntub21lX2FicmV2fTwvcD48cD57bm9tZV9lbWl0fTwvcD48cD57Y25wan08L3A+PHA+e2NvZF9yZXB9IC0ge25vbWVfcmVwcmVzfTwvcD4NCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICA=","email_copys":[["users_groups","users_groups","model","model"],["Comercial","Financeiro","email_rep","email_emit"]],"email_config":"1","email_subject":"Solicita\u00e7\u00e3o de cadastro","email_attachments":[["model_array"],["documentos"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(3)->id){
            $model = Triggers::instance()->getById(3);
            $model->trigger_class = 'concluir_emitente_comercial';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHA+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij5DbGllbnRlIGluc2VyaWRvIG5vIHBvcnRhbC4gQWd1YXJkYW5kbyBhcHJvdmHDp8OjbyBkbyBjb21lcmNpYWwuPC9zcGFuPjwvcD48cD48YSBocmVmPSJodHRwOi8vbm92YV9tb3RvcmVzLmxvY2FsL0VtaXRlbnRlL2Zvcm0vJTdCY29kX3BvcnRhbCU3RCIgdGFyZ2V0PSJfYmxhbmsiPkxpbmsgZG8gZW1pdGVudGU8L2E+PC9wPjxwPntub21lX2FicmV2fTwvcD48cD57bm9tZV9lbWl0fTwvcD48cD57Y25wan08L3A+PHA+e2NvZF9yZXB9IC0ge25vbWVfcmVwcmVzfTwvcD4gICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAg","email_copys":[["users_groups","model","model"],["Comercial","email_rep","email_emit"]],"email_config":"1","email_subject":"Solicita\u00e7\u00e3o de cadastro","email_attachments":[["model_array"],["documentos"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(4)->id){
            $model = Triggers::instance()->getById(4);
            $model->trigger_class = 'aprovar_emitente_financeiro';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHA+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij5DbGllbnRlIGFwcm92YWRvIHBlbG8gZmluYW5jZWlybywgYWd1YXJkYW5kbyBhcHJvdmHDp8OjbyBkbyBDb21lcmNpYWwuPC9zcGFuPjwvcD48cD57bm9tZV9hYnJldn08L3A+PHA+e25vbWVfZW1pdH08L3A+PHA+e2NucGp9PC9wPjxwPntjb2RfcmVwfSAtIHtub21lX3JlcHJlc308L3A+PHA+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij4gICAgICAgICAgICAgIDwvc3Bhbj48L3A+DQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAg","email_copys":[["users_groups","model","model"],["Comercial","email_rep","email_emit"]],"email_config":"1","email_subject":"Libera\u00e7\u00e3o de Cliente","email_attachments":[["model_array"],[""]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(5)->id){
            $model = Triggers::instance()->getById(5);
            $model->trigger_class = 'reprovar_emitente_financeiro';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPkNsaWVudGUgbsOjbyBhcHJvdmFkbyBwZWxvIEZpbmFuY2Vpcm88L3NwYW4+PC9kaXY+PGRpdj48YnI+PC9kaXY+PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPntub21lX2FicmV2fTwvc3Bhbj48L2Rpdj48ZGl2PjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+PGJyPjwvc3Bhbj48L2Rpdj48ZGl2PjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+e25vbWVfZW1pdH08L3NwYW4+PC9kaXY+PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPjxicj48L3NwYW4+PC9kaXY+PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPntjbnBqfTwvc3Bhbj48L2Rpdj48ZGl2PjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+PGJyPjwvc3Bhbj48L2Rpdj48ZGl2PjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+e2NvZF9yZXB9IC0ge25vbWVfcmVwcmVzfTwvc3Bhbj48L2Rpdj48ZGl2Pjxicj48L2Rpdj48ZGl2PjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+e29ic19jb21wbGVtZW50YXJ9PC9zcGFuPjwvZGl2PiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICA=","email_copys":[["users_groups","model"],["Comercial","email_rep"]],"email_config":"1","email_subject":"Libera\u00e7\u00e3o Negada Pelo Financeiro","email_attachments":""}';
            $model->save();
        }
        if (!Triggers::instance()->getById(6)->id){
            $model = Triggers::instance()->getById(6);
            $model->trigger_class = 'submeter_diretoria_emitente_financeiro';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IDQwMDsiPlJlYXZhbGlhw6fDo28gZGUgY3LDqWRpdG8gZG8mbmJzcDtjbGllbnRlIG5vIGZpbmFuY2Vpcm8mbmJzcDs8L3NwYW4+PGEgaHJlZj0iaHR0cDovL25vdmFfbW90b3Jlcy5sb2NhbC9FbWl0ZW50ZS9mb3JtLyU3QmNvZF9wb3J0YWwlN0QiIHRhcmdldD0iX2JsYW5rIiBzdHlsZT0iYmFja2dyb3VuZC1jb2xvcjogcmdiKDI1NSwgMjU1LCAyNTUpOyI+e25vbWVfYWJyZXZ9PC9hPjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogNDAwOyI+Jm5ic3A7LSBSZWF2YWxpYTwvc3Bhbj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IDQwMDsgZm9udC1zaXplOiAwLjg3NXJlbTsiPsOnw6NvIGRlIGNyw6lkaXRvPC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij48YnI+PC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij57bm9tZV9hYnJldn08L3NwYW4+PC9kaXY+PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPjxicj48L3NwYW4+PC9kaXY+PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPntub21lX2VtaXR9PC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij48YnI+PC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij57Y25wan08L3NwYW4+PC9kaXY+PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPjxicj48L3NwYW4+PC9kaXY+PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPntjb2RfcmVwfSAtIHtub21lX3JlcHJlc308L3NwYW4+PC9kaXY+ICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA==","email_copys":[["users_groups","model"],["Diretoria","email_gerente"]],"email_config":"1","email_subject":"Reavalia\u00e7\u00e3o de cr\u00e9dito submetida a diretoria","email_attachments":[["model_array"],["documentos"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(7)->id){
            $model = Triggers::instance()->getById(7);
            $model->trigger_class = 'aprovar_emitente_comercial';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHA+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiA0MDA7Ij5DbGllbnRlIGFwcm92YWRvIHBlbGEgw6FyZWEgY29tZXJjaWFsPC9zcGFuPjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+Ljwvc3Bhbj48L3A+PHA+PGEgaHJlZj0iaHR0cDovL25vdmFfbW90b3Jlcy5sb2NhbC9FbWl0ZW50ZS9mb3JtLyU3QmNvZF9wb3J0YWwlN0QiIHRhcmdldD0iX2JsYW5rIj5MaW5rIGRvIGVtaXRlbnRlPC9hPjwvcD48cD57bm9tZV9hYnJldn08L3A+PHA+e25vbWVfZW1pdH08L3A+PHA+e2NucGp9PC9wPjxwPntjb2RfcmVwfSAtIHtub21lX3JlcHJlc308L3A+ICAgICAgICAgICAgICA=","email_copys":[["users_groups","model","model"],["Comercial","email_emit","email_rep"]],"email_config":"1","email_subject":"Cliente aprovado pela \u00e1rea comercial","email_attachments":[["model_array"],["documentos"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(8)->id){
            $model = Triggers::instance()->getById(8);
            $model->trigger_class = 'reprovar_emitente_comercial';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHA+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiA0MDA7Ij5DbGllbnRlIHJlcHJvdmFkbyBwZWxhIMOhcmVhIGNvbWVyY2lhbDwvc3Bhbj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPi48L3NwYW4+PC9wPjxwPjxhIGhyZWY9Imh0dHA6Ly9ub3ZhX21vdG9yZXMubG9jYWwvRW1pdGVudGUvZm9ybS8lN0Jjb2RfcG9ydGFsJTdEIiB0YXJnZXQ9Il9ibGFuayI+TGluayBkbyBlbWl0ZW50ZTwvYT48L3A+PHA+e25vbWVfYWJyZXZ9PC9wPjxwPntub21lX2VtaXR9PC9wPjxwPntjbnBqfTwvcD48cD57Y29kX3JlcH0gLSB7bm9tZV9yZXByZXN9PC9wPiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA==","email_copys":[["model","users_groups","model"],["email_emit","Comercial","email_rep"]],"email_config":"1","email_subject":"Cliente reprovado pela \u00e1rea comercial","email_attachments":""}';
            $model->save();
        }
        if (!Triggers::instance()->getById(9)->id){
            $model = Triggers::instance()->getById(9);
            $model->trigger_class = 'aprovar_emitente_reavalia_credito';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHA+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij5SZWF2YWxpYcOnw6NvIGRlIGNyw6lkaXRvIGRvIGNsaWVudGUgYXByb3ZhZG8gcGVsbyBmaW5hbmNlaXJvLiBBZ3VhcmRhbmRvJm5ic3A7PC9zcGFuPjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogNDAwOyI+YWd1YXJkYW5kbyBpbnRlZ3Jhw6fDo28gY29tIEVSUC48L3NwYW4+PC9wPjxwPntub21lX2FicmV2fTwvcD48cD57bm9tZV9lbWl0fTwvcD48cD57Y25wan08L3A+PHA+e2NvZF9yZXB9IC0ge25vbWVfcmVwcmVzfTwvcD48cD48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPiAgICAgICAgICAgICAgPC9zcGFuPjwvcD4NCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAg","email_copys":[["users_groups","model","model"],["Comercial","email_rep","email_emit"]],"email_config":"1","email_subject":"Reavalia\u00e7\u00e3o do cr\u00e9dito liberada","email_attachments":[["model_array"],[""]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(10)->id){
            $model = Triggers::instance()->getById(10);
            $model->trigger_class = 'reprovar_emitente_reavalia_credito';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPlJlYXZhbGlhw6fDo28gZG8gY3LDqWRpdG8gZG8gY2xpZW50ZSBuw6NvIGFwcm92YWRvIHBlbG8gRmluYW5jZWlybzwvc3Bhbj48L2Rpdj48ZGl2Pjxicj48L2Rpdj48ZGl2PjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+e25vbWVfYWJyZXZ9PC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij48YnI+PC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij57bm9tZV9lbWl0fTwvc3Bhbj48L2Rpdj48ZGl2PjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+PGJyPjwvc3Bhbj48L2Rpdj48ZGl2PjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+e2NucGp9PC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij48YnI+PC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij57Y29kX3JlcH0gLSB7bm9tZV9yZXByZXN9PC9zcGFuPjwvZGl2PjxkaXY+PGJyPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij57b2JzX2NvbXBsZW1lbnRhcn08L3NwYW4+PC9kaXY+ICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICA=","email_copys":[["users_groups","model"],["Comercial","email_rep"]],"email_config":"1","email_subject":"Reavalia\u00e7\u00e3o de cr\u00e9dito negada pelo financeiro","email_attachments":[["model_array"],[""]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(11)->id){
            $model = Triggers::instance()->getById(11);
            $model->trigger_class = 'submete_diretoria_emitente_reavalia_credito';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IDQwMDsiPlJlYXZhbGlhw6fDo28gZGUgY3LDqWRpdG8gZG8mbmJzcDtjbGllbnRlIG5vIGZpbmFuY2Vpcm8mbmJzcDs8L3NwYW4+PGEgaHJlZj0iaHR0cDovL25vdmFfbW90b3Jlcy5sb2NhbC9FbWl0ZW50ZS9mb3JtLyU3QmNvZF9wb3J0YWwlN0QiIHRhcmdldD0iX2JsYW5rIiBzdHlsZT0iYmFja2dyb3VuZC1jb2xvcjogcmdiKDI1NSwgMjU1LCAyNTUpOyI+e25vbWVfYWJyZXZ9PC9hPjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogNDAwOyI+Jm5ic3A7LSBDYWRhc3RybyBkbyBjbGllbnRlPC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij48YnI+PC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij57bm9tZV9hYnJldn08L3NwYW4+PC9kaXY+PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPjxicj48L3NwYW4+PC9kaXY+PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPntub21lX2VtaXR9PC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij48YnI+PC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij57Y25wan08L3NwYW4+PC9kaXY+PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPjxicj48L3NwYW4+PC9kaXY+PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPntjb2RfcmVwfSAtIHtub21lX3JlcHJlc308L3NwYW4+PC9kaXY+ICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAg","email_copys":[["users_groups","model"],["Diretoria","email_gerente"]],"email_config":"1","email_subject":"Reavalia\u00e7\u00e3o de cr\u00e9dito submetida a diretoria","email_attachments":[["model_array"],["documentos"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(12)->id){
            $model = Triggers::instance()->getById(12);
            $model->trigger_class = 'reavaliar_emitente_financeiro';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHA+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiA0MDA7Ij5Tb2xpY2l0YcOnw6NvIGRlIHJlYXZhbGlhw6fDo28gZGUgY3LDqWRpdG8gZG8gY2xpZW50ZS48L3NwYW4+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij4mbmJzcDtBZ3VhcmRhbmRvIGFwcm92YcOnw6NvIGRvIGZpbmFuY2Vpcm8uPC9zcGFuPjwvcD48cD48YSBocmVmPSJodHRwOi8vbm92YV9tb3RvcmVzLmxvY2FsL0VtaXRlbnRlL2Zvcm0ve2NvZF9wb3J0YWx9IiB0YXJnZXQ9Il9ibGFuayI+TGluayBkbyBlbWl0ZW50ZTwvYT48L3A+PHA+e25vbWVfYWJyZXZ9PC9wPjxwPntub21lX2VtaXR9PC9wPjxwPntjbnBqfTwvcD48cD57Y29kX3JlcH0gLSB7bm9tZV9yZXByZXN9PC9wPg0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICA=","email_copys":[["users_groups","users_groups","model"],["Comercial","Financeiro","email_rep"]],"email_config":"1","email_subject":"Reavalia\u00e7\u00e3o de cr\u00e9dito do cliente","email_attachments":[["model_array"],["documentos"]]}';
            $model->save();
        }

        if (!Triggers::instance()->getById(13)->id){
            $model = Triggers::instance()->getById(13);
            $model->trigger_class = 'enviar_email_agenda';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHA+e25hcnJhdGl2YX08c3BhbiBzdHlsZT0iYmFja2dyb3VuZC1jb2xvcjogcmdiKDMwLCAzMCwgMzApOyBjb2xvcjogcmdiKDIxMiwgMjEyLCAyMTIpOyBmb250LWZhbWlseTogQ29uc29sYXMsICZxdW90O0NvdXJpZXIgTmV3JnF1b3Q7LCBtb25vc3BhY2U7IGZvbnQtd2VpZ2h0OiBub3JtYWw7IHdoaXRlLXNwYWNlOiBwcmU7IGZvbnQtc2l6ZTogMC44NzVyZW07Ij48L3NwYW4+PC9wPg==","email_copys":[["model","model","model"],["email_rep","email_emit","user_email"]],"email_config":"1","email_subject":"{assunto}","email_attachments":""}';
            $model->save();
        }
        if (!Triggers::instance()->getById(14)->id){
            $model = Triggers::instance()->getById(14);
            $model->trigger_class = 'concluir_requisicao';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PGRpdj5SZXF1aXNpw6fDo28gY29uY2x1aWRhLiZuYnNwOzwvZGl2PjxkaXY+PGEgaHJlZj0iaHR0cDovL3tsaW5rX3BkZn0iIHRhcmdldD0iX2JsYW5rIj5QREY8L2E+ICZuYnNwOzwvZGl2PjxkaXY+PGEgaHJlZj0iaHR0cDovL3tsaW5rX3JlcXVpc2ljYW99IiB0YXJnZXQ9Il9ibGFuayI+UmVxdWlzacOnw6NvPC9hPjwvZGl2PjxkaXY+PGEgaHJlZj0iaHR0cDovL3tsaW5rX29yY2FtZW50b3N9IiB0YXJnZXQ9Il9ibGFuayI+T3LDp2FtZW50b3M8L2E+PGJyPjwvZGl2PiAgICAgICAgICAgICAg","email_copys":[["model"],["email_gerente"]],"email_config":"1","email_subject":"Requisi\u00e7\u00e3o concluida","email_attachments":[["model_array"],["orcamentos"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(15)->id){
            $model = Triggers::instance()->getById(15);
            $model->trigger_class = 'rejeita_requisicao_gerente';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPlJlcXVpc2nDp8OjbyByZWplaXRhZGEgcGVsbyBnZXJlbnRlLiA8L3NwYW4+PC9kaXY+PGRpdj48YSBocmVmPSJodHRwOi8ve2xpbmtfcGRmfSIgdGFyZ2V0PSJfYmxhbmsiPlBERjwvYT48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPjxicj48L3NwYW4+PC9kaXY+PGRpdj48YSBocmVmPSJodHRwOi8ve2xpbmtfcmVxdWlzaWNhb30iIHRhcmdldD0iX2JsYW5rIj5SZXF1aXNpw6fDo288L2E+PGJyPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij4tIE9CUy46Jm5ic3A7IHtvYnNfZ2VyZW50ZX08L3NwYW4+PC9kaXY+ICAgICAgICAgICAgICANCiAgICAgICAgICAgICAg","email_copys":[["model"],["email_solicitante"]],"email_config":"1","email_subject":"Requisi\u00e7\u00e3o rejeitada pelo gerente","email_attachments":[["model_array"],["orcamentos"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(16)->id){
            $model = Triggers::instance()->getById(16);
            $model->trigger_class = 'reprova_requisicao_gerente';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHA+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij5SZXF1aXNpw6fDo28gcmVwcm92YWRhIHBlbG8gZ2VyZW50ZS48L3NwYW4+PC9wPjxwPjxhIGhyZWY9Imh0dHA6Ly97bGlua19wZGZ9IiB0YXJnZXQ9Il9ibGFuayI+UERGPC9hPjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+PGJyPjwvc3Bhbj48YSBocmVmPSJodHRwOi8ve2xpbmtfcmVxdWlzaWNhb30iIHRhcmdldD0iX2JsYW5rIj5SZXF1aXNpw6fDo288L2E+PC9wPjxwPiZuYnNwO09CUy46IHtvYnNfZ2VyZW50ZX08YnI+PC9wPg0KICAgICAgICAgICAgICA=","email_copys":[["model"],["email_solicitante"]],"email_config":"1","email_subject":"Requisi\u00e7\u00e3o reprovada pelo gerente","email_attachments":[["model_array"],["orcamentos"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(17)->id){
            $model = Triggers::instance()->getById(17);
            $model->trigger_class = 'aceita_requisicao_gerente';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPlJlcXVpc2nDp8OjbyBhcHJvdmFkYSBwZWxvIGdlcmVudGUuIDwvc3Bhbj48L2Rpdj48ZGl2PjxhIGhyZWY9Imh0dHA6Ly97bGlua19wZGZ9IiB0YXJnZXQ9Il9ibGFuayI+UERGPC9hPjwvZGl2PjxkaXY+PGEgaHJlZj0iaHR0cDovL3tsaW5rX3JlcXVpc2ljYW99IiB0YXJnZXQ9Il9ibGFuayI+UmVxdWlzacOnw6NvPC9hPjxicj48L2Rpdj48ZGl2PjxhIGhyZWY9Imh0dHA6Ly97bGlua19vcmNhbWVudG9zfSIgdGFyZ2V0PSJfYmxhbmsiPk9yw6dhbWVudG9zPC9hPjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyBmb250LXNpemU6IDAuODc1cmVtOyI+PGJyPjwvc3Bhbj48L2Rpdj48ZGl2PjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyBmb250LXNpemU6IDAuODc1cmVtOyI+LSBPQlMuOiB7b2JzX2dlcmVudGV9PC9zcGFuPjwvZGl2PiAgICAgICAgICAgICAg","email_copys":[["model","email"],["email_solicitante","compras@novamotores.com.br"]],"email_config":"1","email_subject":"Requisi\u00e7\u00e3o aprovada pelo gerente","email_attachments":[["model_array"],["orcamentos"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(18)->id){
            $model = Triggers::instance()->getById(18);
            $model->trigger_class = 'rejeita_requisicao_comprador';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPlJlcXVpc2nDp8OjbyByZWplaXRhZGEgcGVsbyBjb21wcmFkb3IuIDwvc3Bhbj48L2Rpdj48ZGl2PjxhIGhyZWY9Imh0dHA6Ly97bGlua19wZGZ9IiB0YXJnZXQ9Il9ibGFuayI+UERGPC9hPjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+PGJyPjwvc3Bhbj48L2Rpdj48ZGl2PjxhIGhyZWY9Imh0dHA6Ly97bGlua19yZXF1aXNpY2FvfSIgdGFyZ2V0PSJfYmxhbmsiPlJlcXVpc2nDp8OjbzwvYT48YnI+PC9kaXY+PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPi0gT0JTLjombmJzcDsge29ic19jb21wcmFkb3J9PC9zcGFuPjwvZGl2PiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA==","email_copys":[["model","model","model"],["email_solicitante","email_fornecedor","email_gerente"]],"email_config":"1","email_subject":"Requisi\u00e7\u00e3o rejeitada pelo comprador","email_attachments":[["model_array"],["orcamentos"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(19)->id){
            $model = Triggers::instance()->getById(19);
            $model->trigger_class = 'reprova_requisicao_comprador';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHA+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij5SZXF1aXNpw6fDo28gcmVwcm92YWRhIHBlbG8gY29tcHJhZG9yLjwvc3Bhbj48L3A+PHA+PGEgaHJlZj0iaHR0cDovL3tsaW5rX3BkZn0iIHRhcmdldD0iX2JsYW5rIj5QREY8L2E+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij48YnI+PC9zcGFuPjxhIGhyZWY9Imh0dHA6Ly97bGlua19yZXF1aXNpY2FvfSIgdGFyZ2V0PSJfYmxhbmsiPlJlcXVpc2nDp8OjbzwvYT48L3A+PHA+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij4mbmJzcDtPQlMuOiB7b2JzX2NvbXByYWRvcn08L3NwYW4+PGJyPjwvcD4NCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICA=","email_copys":[["model","model","model"],["email_solicitante","email_fornecedor","email_gerente"]],"email_config":"1","email_subject":"Requisi\u00e7\u00e3o reprovada pelo comprador","email_attachments":[["model_array"],["orcamentos"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(20)->id){
            $model = Triggers::instance()->getById(20);
            $model->trigger_class = 'aceita_requisicao_comprador';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPlJlcXVpc2nDp8OjbyBhcHJvdmFkYSBwZWxvIGNvbXByYWRvci4gPC9zcGFuPjwvZGl2PjxkaXY+PGEgaHJlZj0iaHR0cDovL3tsaW5rX3BkZn0iIHRhcmdldD0iX2JsYW5rIj5QREY8L2E+PC9kaXY+PGRpdj48YSBocmVmPSJodHRwOi8ve2xpbmtfcmVxdWlzaWNhb30iIHRhcmdldD0iX2JsYW5rIj5SZXF1aXNpw6fDo288L2E+PGJyPjwvZGl2PjxkaXY+PGEgaHJlZj0iaHR0cDovL3tsaW5rX29yY2FtZW50b3N9IiB0YXJnZXQ9Il9ibGFuayI+T3LDp2FtZW50b3M8L2E+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7IGZvbnQtc2l6ZTogMC44NzVyZW07Ij48YnI+PC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7IGZvbnQtc2l6ZTogMC44NzVyZW07Ij4tIE9CUy46IHtvYnNfY29tcHJhZG9yfTwvc3Bhbj48L2Rpdj4gICAgICAgICAgICAgIA0KICAgICAgICAgICAgICA=","email_copys":[["model","model","model"],["email_solicitante","email_fornecedor","email_gerente"]],"email_config":"1","email_subject":"Requisi\u00e7\u00e3o aprovada pelo comprador","email_attachments":[["model_array"],["orcamentos"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(21)->id){
            $model = Triggers::instance()->getById(21);
            $model->trigger_class = 'submete_diretoria_requisicao';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPlJlcXVpc2nDp8OjbyBhcHJvdmFkYSBwZWxvIGdlcmVudGUuIDwvc3Bhbj48L2Rpdj48ZGl2PjxhIGhyZWY9Imh0dHA6Ly97bGlua19wZGZ9IiB0YXJnZXQ9Il9ibGFuayI+UERGPC9hPjwvZGl2PjxkaXY+PGEgaHJlZj0iaHR0cDovL3tsaW5rX3JlcXVpc2ljYW99IiB0YXJnZXQ9Il9ibGFuayI+UmVxdWlzacOnw6NvPC9hPjxicj48L2Rpdj48ZGl2PjxhIGhyZWY9Imh0dHA6Ly97bGlua19vcmNhbWVudG9zfSIgdGFyZ2V0PSJfYmxhbmsiPk9yw6dhbWVudG9zPC9hPjwvZGl2PjxkaXY+PGJyPjwvZGl2PjxkaXY+Jm5ic3A7PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij5WYWxvciB0b3RhbCBhcHJvdmHDp8O1ZXMgbm8gbcOqczoge3ZhbG9yX3RvdGFsX21lc308L3NwYW4+PGJyPjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogNDAwOyI+VmFsb3IgdG90YWwgZGEgcmVxdWlzacOnw6NvOiB7dmFsb3JfdG90YWx9PC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiA0MDA7Ij48YnI+PC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7IGZvbnQtc2l6ZTogMC44NzVyZW07Ij4tIE9CUy46IHtvYnNfY29tcHJhZG9yfTwvc3Bhbj48L2Rpdj4gICAgICAgICAgICAgIA0KICAgICAgICAgICAgICA=","email_copys":[["model","email","model"],["email_gerente","morita@novapart.com.br","email_comprador"]],"email_config":"1","email_subject":"Requisi\u00e7\u00e3o submetida a diretoria","email_attachments":[["model_array"],["orcamentos"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(22)->id){
            $model = Triggers::instance()->getById(22);
            $model->trigger_class = 'concluir_pedido_excecao';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"","email_copys":[["model","email"],["email_gerente","morita@novapart.com.br"]],"email_config":"1","email_subject":"Requisi\u00e7\u00e3o submetida a diretoria","email_attachments":[["model_array"],["orcamentos"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(23)->id){
            $model = Triggers::instance()->getById(23);
            $model->trigger_class = 'submeter_diretoria_pedido_financeiro';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"","email_copys":[["model","email"],["email_gerente","morita@novapart.com.br"]],"email_config":"1","email_subject":"Requisi\u00e7\u00e3o submetida a diretoria","email_attachments":[["model_array"],["orcamentos"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(24)->id){
            $model = Triggers::instance()->getById(24);
            $model->trigger_class = 'aprovar_pedido_comercial';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPlByZXphZG8oYSkgezwvc3Bhbj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IDQwMDsiPm5vbWVfZW1pdDwvc3Bhbj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPn0sPC9zcGFuPjwvZGl2PjxkaXY+PGJyPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij5Db25maXJtYW1vcyBvIHJlY2ViaW1lbnRvIGRvIHBlZGlkbyBuwrogezwvc3Bhbj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IDQwMDsiPm5yX3BlZGlkb19lcnA8L3NwYW4+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7IGZvbnQtc2l6ZTogMC44NzVyZW07Ij59LiBBbmV4byBhIGVzdGUgZS1tYWlsLCBjb25zdGEgdW1hIGPDs3BpYSBkbyBwZWRpZG8gcGFyYSBzdWEgcmVmZXLDqm5jaWEuPC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij5DYXNvIHZvY8OqIHRlbmhhIGFsZ3VtYSBkw7p2aWRhIGVzcGVjw61maWNhIHNvYnJlIG8gcGVkaWRvIG91IHByZWNpc2UgZGUgbWFpcyBpbmZvcm1hw6fDtWVzLCBwb3IgZmF2b3IsIGVudHJhciBlbSBjb250YXRvIGNvbSBvIG5vc3NvIFJlcHJlc2VudGFudGUgQ29tZXJjaWFsIG91IGNvbSBhIG5vc3NhIGVxdWlwZSBpbnRlcm5hIGRlIHZlbmRhcy48L3NwYW4+PC9kaXY+PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPkFncmFkZWNlbW9zIHBvciBlc2NvbGhlciBhIE5vdmEgTW90b3JlcyBlIEZpb3MgTHRkYS4gRXN0YW1vcyBlbXBlbmhhZG9zIGVtIG9mZXJlY2VyIHByb2R1dG9zIGRlIGFsdGEgcXVhbGlkYWRlIGUgdW0gZXhjZWxlbnRlIGF0ZW5kaW1lbnRvIGFvIGNsaWVudGUuPC9zcGFuPjwvZGl2PjxkaXY+PGJyPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij5BdGVuY2lvc2FtZW50ZSw8L3NwYW4+PC9kaXY+PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPk5vdmEgTW90b3JlcyBlIEZpb3MgTHRkYS48L3NwYW4+PC9kaXY+ICAgICAgICAgICAgICA=","email_copys":[["users_groups","model","model"],["Comercial","email_rep","email_emit"]],"email_config":"1","email_subject":"Confirma\u00e7\u00e3o de Pedido - Nova Motores e Fios Ltda.","email_attachments":[["model_array"],["orcamentos"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(25)->id){
            $model = Triggers::instance()->getById(25);
            $model->trigger_class = 'integracao_requisicao';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij5TdWEgcmVxdWlzacOnw6NvIGRlIGNvbXByYXMgbnIue25yX3JlcXVpc2ljYW99Jm5ic3A7IEZvaSByZWpldGVpZGEgbm8gRVJQLiB7Y29udGV1ZG9fZXJwfTwvc3Bhbj4=","email_copys":[["model","model"],["email_solicitante","email_comprador"]],"email_config":"1","email_subject":"Requisi\u00e7\u00e3o de Compras rejeitada na integra\u00e7\u00e3o com o ERP","email_attachments":""}';
            $model->save();
        }
        if (!Triggers::instance()->getById(26)->id){
            $model = Triggers::instance()->getById(26);
            $model->trigger_class = 'aprova_pedido_compra';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij57Y29udGV1ZG99PC9zcGFuPg==","email_copys":[["model","model"],["email_conclui","email_responsavel"]],"email_config":"1","email_subject":"Pedido de compra N\u00ba {nr_pedido_portal}, foi {evento}","email_attachments":[["model_array"],["pdf"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(27)->id){
            $model = Triggers::instance()->getById(27);
            $model->trigger_class = 'reprova_pedido_compra';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij57Y29udGV1ZG99PC9zcGFuPg==","email_copys":[["model","model"],["email_conclui","email_responsavel"]],"email_config":"1","email_subject":"Pedido de compra N\u00ba {nr_pedido_portal}, foi {evento}","email_attachments":[["model_array"],["pdf"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(28)->id){
            $model = Triggers::instance()->getById(28);
            $model->trigger_class = 'laudo_assistencia';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"e2NvbnRldWRvfSAgICAgICAgICAgICAg","email_copys":[["model","model","model"],["email_at","email_cliente","param_email"]],"email_config":"1","email_subject":" Laudo T\u00e9cnico nr. {id} - OS: {ord_serv_id}","email_attachments":[["model_array"],["anexo"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(29)->id){
            $model = Triggers::instance()->getById(29);
            $model->trigger_class = 'qualidade_reservas';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij5SZWxhdMOzcmlvIGRlIG5lY2Vzc2lkYWRlIHBhcmEgbW9udGFnZW0gZGUgbW90b3Jlczoge25yX29yZF9wcm9kfSAtIHtpdF9jb2RpZ299IC0ge2Rlc2NyaWNhb18xfSAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIDwvc3Bhbj4NCiAgICAgICAgICAgICAg","email_copys":[["email"],["producao@novamotores.com.br"]],"email_config":"1","email_subject":"Relat\u00f3rio de necessidade para montagem de motores: {nr_ord_prod} - {it_codigo} - {descricao_1}","email_attachments":[["model_array"],["path"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(30)->id){
            $model = Triggers::instance()->getById(30);
            $model->trigger_class = 'assistencia_nf';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPkNBREFTVFJBRE8gTkYgREUgUFJFU1RBw4fDg08gREUgU0VSVknDh08gQVRSQVbDiVMgRE8gUE9SVEFMPC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij48YnI+PC9zcGFuPjwvZGl2PjxkaXY+QVNTSVNUw4pOQ0lBPHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij46IHtjb2RfYXR9IC0ge25vbWVfZW1pdH0uJmx0O2JyJmd0Ozwvc3Bhbj48L2Rpdj48ZGl2Pk7CsCBEQSBORjo8c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPiZuYnNwO3tucl9uZnN9Ljwvc3Bhbj48L2Rpdj48ZGl2PjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+PGJyPjwvc3Bhbj48L2Rpdj48ZGl2PjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+Tk9UQTogTyBQUkFaTyBERSBQQUdBTUVOVE8gUEFSQSBORiBERSBTRVJWScOHT1Mgw4kgREUgQVTDiSAzMCBESUFTIENPTlRBRE9TIEEgUEFSVElSIERBIEFQUk9WQcOHw4NPIERPIFNFVE9SIEZJTkFOQ0VJUk8sIENBU08gTsODTyBTRUpBIElERU5USUZJQ0FETyBPIFBBR0FNRU5UTyBERU5UUk8gREVTVEUgUFJBWk8sIFBFRElNT1MgUE9SIEdFTlRJTEVaQSBOT1MgSU5GT1JNQVIgVklBIEUtTUFJTC48L3NwYW4+PC9kaXY+ICAgICAgICAgICAgICA=","email_copys":[["model","model"],["grupo_email","email_at"]],"email_config":"1","email_subject":"NF {nr_nfs} cadastrada no portal","email_attachments":""}';
            $model->save();
        }
        if (!Triggers::instance()->getById(31)->id){
            $model = Triggers::instance()->getById(31);
            $model->trigger_class = 'assistencia_nf_conf_aprov';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPk5GIEFQUk9WQURBIFBFTEEgQVNTSVNUw4pOQ0lBIFTDiUNOSUNBLCBFTkNBTUlOSEFEQSBQQVJBIFZFUklGSUNBw4fDg08gRSBMQU7Dh0FNRU5UTyBETyBTRVRPUiBDT05Uw4FCSUwuPC9zcGFuPjwvZGl2PjxkaXY+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij48YnI+PC9zcGFuPjwvZGl2PjxkaXY+QVNTSVNUw4pOQ0lBOiZuYnNwOzxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+e2NvZF9hdH0gLSB7bm9tZV9lbWl0fS48L3NwYW4+PC9kaXY+PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPiZuYnNwOzwvc3Bhbj5OwrAgREEgTkY6PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij4mbmJzcDt7bnJfbmZzfS48L3NwYW4+PC9kaXY+ICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA==","email_copys":[["model","model","users_groups"],["grupo_email","email_at","Controladoria"]],"email_config":"1","email_subject":"NF {nr_nfs} aprovada pela Assist\u00eancia T\u00e9cnica","email_attachments":[["model_array"],[""]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(32)->id){
            $model = Triggers::instance()->getById(32);
            $model->trigger_class = 'assistencia_nf_fin_aprov';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPk5GIEFQUk9WQURBIFBBUkEgUEFHQU1FTlRPIFBFTE8gU0VUT1IgQ09OVMOBQklMLjwvc3Bhbj48L2Rpdj48ZGl2PjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyBmb250LXNpemU6IDAuODc1cmVtOyI+PGJyPjwvc3Bhbj48L2Rpdj48ZGl2PjxzcGFuIHN0eWxlPSJmb250LXNpemU6IDAuODc1cmVtOyI+QVNTSVNUw4pOQ0lBOjwvc3Bhbj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsgZm9udC1zaXplOiAwLjg3NXJlbTsiPiB7Y29kX2F0fSAtIHtub21lX2VtaXR9Ljwvc3Bhbj48L2Rpdj48ZGl2PjxzcGFuIHN0eWxlPSJmb250LXNpemU6IDAuODc1cmVtOyI+TsKwIERBIE5GOjwvc3Bhbj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsgZm9udC1zaXplOiAwLjg3NXJlbTsiPiZuYnNwO3tucl9uZnN9Ljwvc3Bhbj48L2Rpdj4gICAgICAgICAgICAgIA==","email_copys":[["model","model"],["grupo_email","email_at"]],"email_config":"1","email_subject":"NF {nr_nfs} aprovada para pagamento","email_attachments":""}';
            $model->save();
        }
        if (!Triggers::instance()->getById(33)->id){
            $model = Triggers::instance()->getById(33);
            $model->trigger_class = 'assistencia_nf_conf_reprov';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IDQwMDsiPkEgTkYgRU5DQU1JTkhBREEgUEFSQSBQQUdBTUVOVE8gRk9JIFJFUFJPVkFEQSBQRUxPIFNFVE9SIERFIEFTU0lTVMOKTkNJQSBUw4lDTklDQSBERVZJRE8gQSB7b2JzX2Fwcm92X3Nlcn08L3NwYW4+PC9kaXY+PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPjxicj48L3NwYW4+PC9kaXY+PGRpdj5BU1NJU1TDik5DSUE6Jm5ic3A7PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij57Y29kX2F0fSAtIHtub21lX2VtaXR9Ljwvc3Bhbj48L2Rpdj48ZGl2PjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+Jm5ic3A7PC9zcGFuPk7CsCBEQSBORjo8c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPiZuYnNwO3tucl9uZnN9Ljwvc3Bhbj48L2Rpdj4gICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAg","email_copys":[["model","model"],["email_at","grupo_email"]],"email_config":"1","email_subject":"NF {nr_nfs} reprovada pela AT","email_attachments":[["model_array"],[""]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(34)->id){
            $model = Triggers::instance()->getById(34);
            $model->trigger_class = 'assistencia_nf_fin_reprov';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IDQwMDsiPkEgTkYgRU5DQU1JTkhBREEgUEFSQSBQQUdBTUVOVE8gRk9JIFJFUFJPVkFEQSBQRUxPIFNFVE9SJm5ic3A7REUgQ09OVFJPTEFET1JJQSBERVZJRE8gQSB7b2JzX2Fwcm92X2Zpbn08L3NwYW4+PC9kaXY+PGRpdj48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPjxicj48L3NwYW4+PC9kaXY+PGRpdj5BU1NJU1TDik5DSUE6Jm5ic3A7PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij57Y29kX2F0fSAtIHtub21lX2VtaXR9Ljwvc3Bhbj48L2Rpdj48ZGl2PjxzcGFuIHN0eWxlPSJmb250LXdlaWdodDogbm9ybWFsOyI+Jm5ic3A7PC9zcGFuPk7CsCBEQSBORjo8c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IG5vcm1hbDsiPiZuYnNwO3tucl9uZnN9Ljwvc3Bhbj48L2Rpdj4gICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAg","email_copys":[["model","users_groups"],["email_at","Controladoria"]],"email_config":"1","email_subject":"NF {nr_nfs} reprovada pela controladoria","email_attachments":[["model_array"],[""]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(35)->id){
            $model = Triggers::instance()->getById(35);
            $model->trigger_class = 'salva_requisicao_comprador';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij5BIHJlcXVpc2nDp8OjbyBuw7ptZXJvIHtucl9yZXF1aXNpY2FvfSBmb2kgc2FsdmEgZSBhdHJpYnXDrWRhIHBhcmEgbyBjb21wcmFkb3Ige3VzZXJfY29tcHJhZG9yfTwvc3Bhbj4=","email_copys":[["model"],["email_comprador"]],"email_config":"1","email_subject":"Atribui\u00e7\u00e3o do comprador \u00e0 requisi\u00e7\u00e3o","email_attachments":[["model_array"],[""]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(36)->id){
            $model = Triggers::instance()->getById(36);
            $model->trigger_class = 'rejeita_fabrica';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"e2NvbnRldWRvfQ0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAg","email_copys":[["model","model"],["email_cliente","grupo_email"]],"email_config":"1","email_subject":"Aviso de ocorr\u00eancia","email_attachments":[["model_array"],["anexo"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(37)->id){
            $model = Triggers::instance()->getById(37);
            $model->trigger_class = 'aprova_fabrica';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"e2NvbnRldWRvfQ0KICAgICAgICAgICAgICA=","email_copys":[["model"],["email_cliente"]],"email_config":"1","email_subject":"Aviso de ocorr\u00eancia","email_attachments":[["model_array"],["anexo"]]}';
            $model->save();
        }if (!Triggers::instance()->getById(38)->id){
            $model = Triggers::instance()->getById(38);
            $model->trigger_class = 'entregue_assistencia';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"e2NvbnRldWRvfQ0KICAgICAgICAgICAgICA=","email_copys":[["model"],["email_emit"]],"email_config":"1","email_subject":"Aviso de ocorr\u00eancia","email_attachments":[["model_array"],["anexo"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(39)->id){
            $model = Triggers::instance()->getById(39);
            $model->trigger_class = 'concluir_assistencia';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"e2NvbnRldWRvfQ0KICAgICAgICAgICAgICA=","email_copys":[["model","model"],["email_at","grupo_email"]],"email_config":"1","email_subject":"NF {nr_nfs} cadastrada no portal","email_attachments":[["model_array"],["anexo"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(40)->id){
            $model = Triggers::instance()->getById(40);
            $model->trigger_class = 'reprova_fabrica';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"e2NvbnRldWRvfQ0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAg","email_copys":[["model","model"],["email_cliente","grupo_email"]],"email_config":"1","email_subject":"Aviso de ocorr\u00eancia","email_attachments":[["model_array"],["anexo"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(41)->id){
            $model = Triggers::instance()->getById(41);
            $model->trigger_class = 'laudo_assistencia';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"e2NvbnRldWRvfSAgICAgICAgICAgICAg","email_copys":[["model","model","model"],["email_at","email_cliente","grupo_email"]],"email_config":"1","email_subject":" Laudo T\u00e9cnico nr. {id} - OS: {ord_serv_id}","email_attachments":[["model_array"],["anexo"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(42)->id){
            $model = Triggers::instance()->getById(42);
            $model->trigger_class = 'concluir_emitente_financeiro_excecao';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHA+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiA0MDA7Ij5Tb2xpY2l0YcOnw6NvIGRlIGFwcm92YcOnw6NvIGVtIGNhcsOhdGVyIGRlIGV4Y2XDp8OjbyAuIFZlcmlmaXF1ZSBvcyBkYWRvcyBub3MgYW5leG9zPC9zcGFuPjwvcD48cD48c3BhbiBzdHlsZT0iZm9udC13ZWlnaHQ6IDQwMDsiPjxicj48L3NwYW4+PGEgaHJlZj0iaHR0cDovL25vdmFfbW90b3Jlcy5sb2NhbC9FbWl0ZW50ZS9mb3JtL3tjb2RfcG9ydGFsfSIgdGFyZ2V0PSJfYmxhbmsiIHN0eWxlPSJiYWNrZ3JvdW5kLWNvbG9yOiByZ2IoMjU1LCAyNTUsIDI1NSk7IGZvbnQtc2l6ZTogMC44NzVyZW07Ij5MaW5rIGRvIGVtaXRlbnRlPC9hPjwvcD48cD57bm9tZV9hYnJldn08L3A+PHA+e25vbWVfZW1pdH08L3A+PHA+e2NucGp9PC9wPjxwPntjb2RfcmVwfSAtIHtub21lX3JlcHJlc308L3A+DQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA0KICAgICAgICAgICAgICANCiAgICAgICAgICAgICAgDQogICAgICAgICAgICAgIA==","email_copys":[["users_groups","model","model"],["Financeiro","email_rep","email_emit"]],"email_config":"1","email_subject":"Solicita\u00e7\u00e3o de aprova\u00e7\u00e3o de exce\u00e7\u00f5es do cliente: {nome_abrev}","email_attachments":[["model_array"],["documentos"]]}';
            $model->save();
        }
        if (!Triggers::instance()->getById(44)->id){
            $model = Triggers::instance()->getById(44);
            $model->trigger_class = 'conclui_pedido_compra';
            $model->class = 'trigger_class_email';
            $model->config = '{"email_body":"PHA+PHNwYW4gc3R5bGU9ImZvbnQtd2VpZ2h0OiBub3JtYWw7Ij5QZWRpZG8gZGUgY29tcHJhIGNvbmNsdcOtZG8gcG9yIGZvcm5lY2Vkb3IsIG5ywrogcGVkaWRvIHBvcnRhbCB7bnJfcGVkaWRvX3BvcnRhbH0gLSBmb3JuZWNlZG9yIHtjb2RfZm9ybmVjZWRvcn08L3NwYW4+PC9wPjxwPjxhIGhyZWY9IntsaW5rX3BlZGlkb30iIHRhcmdldD0iX2JsYW5rIj5MaW5rIHBlZGlkbzwvYT48YnI+PC9wPg==","email_copys":[["email"],["compras@novamotores.com.br"]],"email_config":"1","email_subject":"Pedido de compra conclu\u00eddo por fornecedor","email_attachments":[["model_array"],["anexo"]]}';
            $model->save();
        }
        return "Trigger populada";
    }

    public function down():string{
        return "teste migracao";
    }
    public function getDatetime():string{
        return "2022-06-19 15:00:00";
    }
}