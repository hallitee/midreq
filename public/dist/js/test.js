/*!
 * Start Bootstrap - SB Admin 2 v3.3.7+1 (http://startbootstrap.com/template-overviews/sb-admin-2)
 * Copyright 2013-2016 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap/blob/gh-pages/LICENSE)
 */
$(function() {
    $('#side-menu').metisMenu();
});

 $(document).ready(function(){	
 var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};
 var id =  getUrlParameter('id');
 var approval =  getUrlParameter('approval');
  var approver =  getUrlParameter('approver');
   var creator =  getUrlParameter('creator');
   console.log('id '+id+' approval '+approval);
  // console.log(name);
  /*
 if(approval==1){
	 BootstrapDialog.show({
            title: 'MID Approval Remarks',
			message: 'Please enter remarks before submitting: <textarea type="text" class="form-control"></textarea>',
            type: BootstrapDialog.TYPE_SUCCESS, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            closable: true, // <-- Default value is false
            draggable: true, // <-- Default value is false
            data: {
                'approval': approval,
                'approver': approver,
                'creator': creator
            },
            buttons: [{
                label: 'APPROVE',
                cssClass: 'btn-success',
                action: function(dialogRef) {
					var mess = dialogRef.getModalBody().find('textarea').val();
					if(mess.length>0){
					
					window.location = "/emailApp?id="+id+"&approval="+approval+"&approver="+approver+"&creator="+"&remarks="+mess
					}else{
					dialogRef.setTitle('MID Approval Remarks - Please enter remarks to continue ');	
		
					}
                }
            },
			{
                label: 'CANCEL',
                cssClass: 'btn-success',
                action: function() {
                    window.location = "/home";
                }
            },
			
			
			],
            callback: function(result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.
                if(result) {
					var mess = dialog.getModalBody().find('textarea').val();
					console.log('mess' + mess);
                    window.location = "/req/create";
                }else {
                   window.location = "/home";
                }
            }
        });
   
 }
 else */
 if(approval==2){
BootstrapDialog.show({
            title: 'MID Approval Remarks',
			message: 'Please enter remarks before submitting: <textarea type="text" class="form-control"></textarea>',
            type: BootstrapDialog.TYPE_DANGER, // <-- Default value is BootstrapDialog.TYPE_PRIMARY
            closable: true, // <-- Default value is false
            draggable: true, // <-- Default value is false
            data: {
                'approval': approval,
                'approver': approver,
                'creator': creator
            },
            buttons: [{
                label: 'UNAPPROVE',
                cssClass: 'btn-danger',
                action: function(dialogRef) {
					var mess = dialogRef.getModalBody().find('textarea').val();
					if(mess.length>0){
					
					window.location = "/emailApp?id="+id+"&approval="+approval+"&approver="+approver+"&creator="+"&remarks="+mess
					}else{
					dialogRef.setTitle('MID Approval Remarks - Please enter remarks to continue ');	
		
					}
                }
            },
			{
                label: 'CANCEL',
                cssClass: 'btn-danger',
                action: function() {
                    window.location = "/home";
                }
            },
			
			
			],
            callback: function(result) {
                // result will be true if button was click, while it will be false if users close the dialog directly.
                if(result) {
					var mess = dialog.getModalBody().find('textarea').val();
					console.log('mess' + mess);
                    window.location = "/req/create";
                }else {
                   window.location = "/home";
                }
            }
        });
	 
	 
 }
 });
//Loads the correct sidebar on window load,
//collapses the sidebar on window resize.
// Sets the min-height of #page-wrapper to window size
$(function() {
    $(window).bind("load resize", function() {
        var topOffset = 50;
        var width = (this.window.innerWidth > 0) ? this.window.innerWidth : this.screen.width;
        if (width < 768) {
            $('div.navbar-collapse').addClass('collapse');
            topOffset = 100; // 2-row-menu
        } else {
            $('div.navbar-collapse').removeClass('collapse');
        }

        var height = ((this.window.innerHeight > 0) ? this.window.innerHeight : this.screen.height) - 1;
        height = height - topOffset;
        if (height < 1) height = 1;
        if (height > topOffset) {
            $("#page-wrapper").css("min-height", (height) + "px");
        }
    });

    var url = window.location;
    // var element = $('ul.nav a').filter(function() {
    //     return this.href == url;
    // }).addClass('active').parent().parent().addClass('in').parent();
    var element = $('ul.nav a').filter(function() {
        return this.href == url;
    }).addClass('active').parent();

    while (true) {
        if (element.is('li')) {
            element = element.parent().addClass('in').parent();
        } else {
            break;
        }
    }
});
