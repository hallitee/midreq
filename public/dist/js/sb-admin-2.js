/*!
 * Start Bootstrap - SB Admin 2 v3.3.7+1 (http://startbootstrap.com/template-overviews/sb-admin-2)
 * Copyright 2013-2016 Start Bootstrap
 * Licensed under MIT (https://github.com/BlackrockDigital/startbootstrap/blob/gh-pages/LICENSE)
 */
$(function() {
    $('#side-menu').metisMenu();
});


 $(document).ready(function(){	

 console.log("started");
$("body").on('click', '.sltList', function(){
	console.log($(this).text());
	$("#myUL").hide();
	 var txt;
    if (confirm("The item is already created. Do you want to stop creating new MID Request.")) {
        txt = "You pressed OK!";
		window.location = "/home";
		
    } else {
        txt = "You pressed Cancel!";
    }
	$("#itemType").val($(this).text());
	console.log(txt);
});
 
$("#itemType").on('keyup', function(){
	  name = $(this).val(); 
	  Ulist = $("#myUL");
	 console.log(name.length);
	 if(name.length>3){
	 				$.ajax({
					type: 'GET',
					url: "/getitem",
					dataType: 'JSON',
					beforeSend: function(xhr)
					{xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))},
					data: {
					"name":name,
					},                                                                                             
					error: function( xhr ){ 
					// alert("ERROR ON SUBMIT");
					console.log("error on submit"+xhr);
					},
					success: function( data ){ 
					console.log("success "+ data);
					//var datas = JSON.parse(data);
					
					$.each(data, function(i, list){
						console.log(" i ", i);
						console.log(" list ", list.ENTITYCODE);
					});
				 
					Ulist.empty();
					Ulist.show();
					$.each(data, function(i, list){
					Ulist.append("<li class='sltList'><a href='#'>"+ list.ITEMCODE + ' - '+list.ITEMNAME +"</a></li>")
					});
					}
				});
	 }
	// $("#myUL").append("<li class='sltList'><a href='#'>Taofik</a></li>");
	 console.log($(this).val());
 });
 
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
