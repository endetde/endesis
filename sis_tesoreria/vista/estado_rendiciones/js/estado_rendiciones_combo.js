/*
 * Ext JS Library 1.0.1
 * Copyright(c) 2006-2007, Ext JS, LLC.
 * licensing@extjs.com
 *
 * http://www.extjs.com/license
 */


Ext.namespace('Ext.estado_rendicion_combo');   

Ext.estado_rendicion_combo.tipo_solicitud = [
        
        ['Todos', 'TODOS'],
   		['rendicion_viatico', 'Rendici�n de Solicitudes de Vi�ticos'],
   		['solicitud_avance', 'Rendici�n de Fondos en Avance'],
   		['rendicion_caja', 'Rendicion de Solicitud de Efectivo']
];

Ext.estado_rendicion_combo.estado_rendicion= [       
	
		//["'en_rendicion,conta_rendicion,fin_rendicion'", 'Todos'],
		
		//["Todos", 'Todos'],
		//['"Todos"', 'Todos'],
		//["'Todos'", 'Todos'],
        /*["'en_rendicion'", 'En Rendici�n'],
        ["'conta_rendicion'", 'Conta Rendici�n'],
        ["'fin_rendicion'", 'Fin Rendici�n'] */  
            
        ['Todos', 'TODOS'],
        ['en_rendicion', 'Rendici�n - En Rendici�n'],
        ['conta_rendicion', 'Rendici�n - Conta Rendici�n'],
        ['fin_rendicion', 'Rendici�n - Fin Rendici�n'], 
        
        //rendiciones de caja
        ['borrador', 'Solicitud - Borrador'],
        //['conta_rendicion', 'Conta Rendici�n'],
       
        ['conta_pago', 'Solicitud - Conta Pago'],
        ['pago_cheque', 'Solicitud - Pago Cheque'],
		['rendicion_validado', 'Solicitud - Rendici�n Validado'],
        ['finalizado', 'Solicitud - Finalizado']   
];        

Ext.estado_rendicion_combo.tipo_reporte = [
        
		['Por Responsable Registro', 'Por Responsable Registro'],
		['Por Funcionario Solicitante', 'Por Funcionario Solicitante'],
		['Por Unidad Organizacional', 'Por Unidad Organizacional'],
		['Por Departamento Contable', 'Por Departamento Contable']       
];
