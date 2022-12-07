<?php


$config = array(
    
        'web/register' => array(
                            array(
                                'field' => 'firstname',
                                'label' => 'First Name',
                                'rules' => 'required'
                            ),
                            array(
                                'field' => 'lastname',
                                'label' => 'Last Name',
                                'rules' => 'required'
                            ),
                            array(
                                'field' => 'email',
                                'label' => 'Email',
                                'rules' => 'required|is_unique[clients.email]'
                            ),
                            array(
                                'field' => 'mobile',
                                'label' => 'Mobile',
                                'rules' => 'required|is_unique[clients.mobile]'
                            ),
                            array(
                                'field' => 'address1',
                                'label' => 'Address 1',
                                'rules' => 'required'
                            ),
                            array(
                                'field' => 'city',
                                'label' => 'City',
                                'rules' => 'required'
                            ),
                            array(
                                'field' => 'state',
                                'label' => 'State',
                                'rules' => 'required'
                            ),
                            array(
                                'field' => 'postcode',
                                'label' => 'Postcode',
                                'rules' => 'required'
                            ),
                            array(
                                'field' => 'lastname',
                                'label' => 'Last Name',
                                'rules' => 'required'
                            ),
                            array(
                                'field' => 'country',
                                'label' => 'Country',
                                'rules' => 'required'
                            ),
                            array(
                                'field' => 'password',
                                'label' => 'Password',
                                'rules' => 'required'
                            ),
                            array(
                                'field' => 'password2',
                                'label' => 'Password',
                                'rules' => 'required|matches[password]'
                            ),
                            array(
                                'field' => 'accepttos',
                                'label' => 'Terms of Service',
                                'rules' => 'required'
                            )
            ),
        'web/login'    => array(
                             array(
                                'field' => 'username',
                                'label' => 'Username',
                                'rules' => 'required'
                            ),
                            array(
                                'field' => 'password',
                                'label' => 'Password',
                                'rules' => 'required'
                            ),
                        )
    
    
    );


?>