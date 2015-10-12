<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
	 *
	 * @return void
	 * @author Christian LLanes
	 **/
       $config = array(
//////////////////////////////////////////validation login////////////////////////////////////////////////////////////////////////////

                'Login_validation' => array(
                                   array(
                                            'field' => 'usuario',
                                            'label' => 'Usuario',
                                            'rules' => 'trim|required|callback_check_nombre|strip_tags'
                                         ),
                                     array(
                                            'field' => 'password',
                                            'label' => 'Contraseña',
                                            'rules' => 'trim|required|callback_check_pass|strip_tags'
                                         ),
                    ),
                                       // final
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////Validacion registro_cliente///////////////////////////////////////////////////////////////////////
                'registro_cliente' => array(

                                    array(
                                            'field' => 'Nombres',
                                            'label' => 'Nombre',
                                            'rules' => 'trim|required|min_length[2]|max_length[30]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Apellidos',
                                            'label' => 'Apellidos',
                                            'rules' => 'trim|min_length[2]|max_length[50]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Direccion',
                                            'label' => 'Direccion',
                                            'rules' => 'trim|required|min_length[2]|max_length[50]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Telefono',
                                            'label' => 'Telefono',
                                            'rules' => 'trim|required|min_length[2]|max_length[15]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Email',
                                            'label' => 'Correo',
                                            'rules' => 'trim|required|valid_email|min_length[1]|max_length[30]|callback_check_email|strip_tags'
                                         ),
                                    array(
                                            'field' => 'usuario',
                                            'label' => 'Usuario',
                                            'rules' => 'trim|required|callback_check_User|strip_tags'
                                         ),
                                     array(
                                            'field' => 'password',
                                            'label' => 'Contraseña',
                                            'rules' => 'trim|required|strip_tags'
                                         ),
                                    array(
                                            'field' => 'passconf',
                                            'label' => 'Confirmar',
                                            'rules' => 'trim|required|strip_tags|matches[password]|md5'
                                         ),

                    ),

                                       // final
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////Validacion update_cliente///////////////////////////////////////////////////////////////////////
                'ajax_update' => array(

                                    array(
                                            'field' => 'Nombres',
                                            'label' => 'Nombre',
                                            'rules' => 'trim|required|min_length[2]|max_length[30]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Apellidos',
                                            'label' => 'Apellidos',
                                            'rules' => 'trim|min_length[2]|max_length[50]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Direccion',
                                            'label' => 'Direccion',
                                            'rules' => 'trim|required|min_length[2]|max_length[50]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Telefono',
                                            'label' => 'Telefono',
                                            'rules' => 'trim|required|min_length[2]|max_length[15]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Email',
                                            'label' => 'Correo',
                                            'rules' => 'trim|required|valid_email|min_length[1]|max_length[30]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'usuario',
                                            'label' => 'Usuario',
                                            'rules' => 'trim|required|strip_tags'
                                         ),
                                     array(
                                            'field' => 'password',
                                            'label' => 'Contraseña',
                                            'rules' => 'trim|required|strip_tags'
                                         ),
                                    array(
                                            'field' => 'passconf',
                                            'label' => 'Confirmar',
                                            'rules' => 'trim|required|strip_tags|matches[password]|md5'
                                         ),

                    ),

                                       // final
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////Validacion registro_cliente///////////////////////////////////////////////////////////////////////
                'registro_empleado' => array(

                                    array(
                                            'field' => 'Nombres',
                                            'label' => 'Nombre',
                                            'rules' => 'trim|required|min_length[3]|max_length[45]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Apellidos',
                                            'label' => 'Apellidos',
                                            'rules' => 'trim|min_length[3]|max_length[45]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Direccion',
                                            'label' => 'Direccion',
                                            'rules' => 'trim|required|min_length[5]|max_length[45]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Telefono',
                                            'label' => 'Telefono',
                                            'rules' => 'trim|required|min_length[6]|max_length[45]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Sueldo',
                                            'label' => 'Sueldo',
                                            'rules' => 'trim|required|min_length[4]|max_length[45]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Cargo',
                                            'label' => 'Cargo',
                                            'rules' => 'trim|required|min_length[4]|max_length[45]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'usuario',
                                            'label' => 'Usuario',
                                            'rules' => 'trim|required|callback_check_User|strip_tags'
                                         ),
                                     array(
                                            'field' => 'password',
                                            'label' => 'Contraseña',
                                            'rules' => 'trim|required|strip_tags'
                                         ),
                                    array(
                                            'field' => 'passconf',
                                            'label' => 'Confirmar',
                                            'rules' => 'trim|required|strip_tags|matches[password]|md5'
                                         ),

                    ),

                                       // final
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////Validacion update_cliente///////////////////////////////////////////////////////////////////////
                'ajax_update_empleado' => array(

                                     array(
                                            'field' => 'Nombres',
                                            'label' => 'Nombre',
                                            'rules' => 'trim|required|min_length[3]|max_length[45]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Apellidos',
                                            'label' => 'Apellidos',
                                            'rules' => 'trim|min_length[3]|max_length[45]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Direccion',
                                            'label' => 'Direccion',
                                            'rules' => 'trim|required|min_length[5]|max_length[45]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Telefono',
                                            'label' => 'Telefono',
                                            'rules' => 'trim|required|min_length[6]|max_length[45]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Sueldo',
                                            'label' => 'Sueldo',
                                            'rules' => 'trim|required|min_length[4]|max_length[45]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Cargo',
                                            'label' => 'Cargo',
                                            'rules' => 'trim|required|min_length[4]|max_length[45]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'usuario',
                                            'label' => 'Usuario',
                                            'rules' => 'trim|required|strip_tags'
                                         ),
                                     array(
                                            'field' => 'password',
                                            'label' => 'Contraseña',
                                            'rules' => 'trim|required|strip_tags'
                                         ),
                                    array(
                                            'field' => 'passconf',
                                            'label' => 'Confirmar',
                                            'rules' => 'trim|required|strip_tags|matches[password]|md5'
                                         ),
                    ),

                                       // final
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////Validacion registro_cliente///////////////////////////////////////////////////////////////////////
                'update_productos' => array(

                                    array(
                                            'field' => 'Codigo',
                                            'label' => 'Codigo',
                                            'rules' => 'trim|required|min_length[1]|max_length[11]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Nombre',
                                            'label' => 'Nombre',
                                            'rules' => 'trim|required|min_length[3]|max_length[45]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Descripcion',
                                            'label' => 'Descripcion',
                                            'rules' => 'trim|required|min_length[5]|max_length[45]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Precio_Unitario',
                                            'label' => 'Precio',
                                            'rules' => 'trim|required|min_length[1]|max_length[11]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Cantidad',
                                            'label' => 'Cantidad',
                                            'rules' => 'trim|required|min_length[1]|max_length[11]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Descuento',
                                            'label' => 'Descuento',
                                            'rules' => 'trim|required|min_length[1]|max_length[11]|strip_tags'
                                         ),
                                     array(
                                            'field' => 'Iva',
                                            'label' => 'Iva',
                                            'rules' => 'trim|required|min_length[1]|max_length[11]|strip_tags'
                                         ),
                                    array(
                                            'field' => 'Img',
                                            'label' => 'Imagen',
                                            'rules' => 'trim|min_length[1]|max_length[45]|strip_tags'
                                         ),
                                     array(
                                            'field' => 'idCategoria',
                                            'label' => 'Categoria',
                                            'rules' => 'trim|required|min_length[1]|max_length[11]|strip_tags'
                                         ),

                    ),
                                       // final
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
               );




