var app = new Framework7({
	root: '#app',
	name: 'F7App',
	id: 'com.ubaya.f7app',
	panel: { swipe: 'left' },
	theme: 'md',
	routes: [
		{
			path : '/index/',
			on : 'index.html',
		},
		{
			path : '/update_kejadian/',
			url : 'upload_kejadian.html',
			on:{
				pageInit:function(e,page){
					app.request.post("http://192.168.1.55/projectpmn/upload_kejadian.php",{},
						function(data){

						}
					);
				}
			}
		},
		{
			path : '/detail_kejadian/:idkejadian/',
			url : 'detail_kejadian.html',
			on : {
				pageInit:function(e,page){
					app.request.post("http://192.168.1.55/projectpmn/detailkejadian.php",{
						idkejadian : page.router.currentRoute.params.idkejadian
					},function(data){
						var d = JSON.parse(data);
						var template = $$('#template').html();
						var compiledTemplate = Template7.compile(template);
						var html = compiledTemplate(d);
						$$('.page-content').html(html);
					});
				}
			}
		},
		{
			path: '/login/',
			url: 'login.html',
			on : {
				pageInit:function(e,page){
					if(localStorage.username){
						page.router.navigate('/kejadiancards/');
					}
				}
			}
		},
		{
			path: '/registration/',
			url: 'registration.html',
		},
		{
			path: '/search/',
			url: 'search.html',
			on:{
				pageInit:function(e,page){
					app.request.post("http://192.168.1.55/projectpmn/index.php",{},
						function(data){
							// app.dialog.alert(data);
						var d = JSON.parse(data);
						var template = $$('#template').html();
						var compiledTemplate = Template7.compile(template);
						var html = compiledTemplate(d);
						$$('.page-content').html(html);
					});
				}
			}
		},
		{
			path: '/kejadiancards/',
			url : 'kejadiancards.html',
			on:{
				pageInit:function(e,page){
					if(!localStorage.username) {				
				       page.router.navigate('/login/');
					}
					app.request.post("http://192.168.1.55/projectpmn/index.php",{},
						function(data){
							// app.dialog.alert(data);
						var d = JSON.parse(data);
						var template = $$('#template').html();
						var compiledTemplate = Template7.compile(template);
						var html = compiledTemplate(d);
						$$('.page-content').html(html);
					});
				}
			}
		},
		{
			path: '/kejadianlist',
			url: 'kejadianlist.html',
			on :{
				pageAfterIn:function(e,page){
					if(!localStorage.username){
						mainView.router.navigate('/login/');
					}
				}
			}
		},
	]
});

var $$ = Dom7;
var mainView = app.views.create('.view-main',{
	url : '/login/'
});
var searchbar = app.searchbar.create({
  el: '.searchbar',
  searchContainer: '.list',
  searchIn: '.item-title',
  on: {
    search(sb, query, previousQuery) {
      console.log(query, previousQuery);
    }
  }
}); 
// var user = '';
if(!localStorage.username){
	mainView.router.navigate('/login/');
}
$$('#btnLogout').on('click', function(){
	localStorage.removeItem(localStorage.username);
	mainView.router.navigate('/login/');
});
$$('#btnsubmit').on('click',function(){
	app.dialog.alert("HAI");
});
$$('#btnrumah').on('click',function(){
	mainView.router.navigate('/kejadiancards/');
});

$$(document).on('page:init', function(e, page){	
	if(page.name == 'login'){
		$$('#btnlogin').on('click', function() {
			var x = new FormData($$(".signin-checker")[0]);
			app.request.post('http://192.168.1.55/projectpmn/loginproses.php', x,function (data) {
			  	if(data[0] == "1"){
			  		localStorage.username = data.substring(1);
			  		page.router.navigate('/kejadiancards/');
			  	}else app.dialog.alert(data);
			});
		});
	}
	if(page.name == 'update_kejadian'){
		app.calendar.create({
		  	inputEl: '#tanggal',
		  	dateFormat : 'yyyy-mm-dd',
		});
		$$('#btnpic').on('click',function(e){
			navigator.camera.getPicture(onSuccess,onFail,{
				quality:100,
				destinationType: Camera.DestinationType.DATA_URL,
				sourceType: Camera.PictureSourceType.CAMERA,
				encodingType: Camera.EncodingType.JPEG,
				mediaType: Camera.MediaType.PICTURE,
				correctOrientation: true
			});
			function onSuccess(imageData){
				$$('#propic').attr("src","data:image/jpeg;base64,"+ imageData);
			}
			function onFail(message){
				app.dialog.alert('Failed because : ' + message);
			}
		});
		$$('#btnsubmit').on('click',function(){
			var x = new FormData($$(".masukin-gambar")[0]);
			app.request.post('http://192.168.1.55/projectpmn/uploadkejadian.php?username='+localStorage.username,x,
				function(data){
					app.dialog.alert(data);
					var ft = new FileTransfer();
					var imgURI = $$("#propic").attr("src");
					if(!imgURI){
						app.dialog.alert('Please select an image first!');
						return;
					}
					var imgUri = $$('#propic').attr('src');
					var option = new FileUploadOptions();
					option.fileKey = "photo";
					option.fileName = imgUri.substr(imgUri.lastIndexOf('/')+1);
					option.mimeType = "image/jpeg";
					option.params = {
						params1 : data,
					};
					var sukses = function (r){
						app.dialog.alert(r);
					}
					var gagal = function(error){
						app.dialog.alert("error on : " + error.code);
					}
					ft.upload(imgUri, encodeURI("http://192.168.1.55/projectpmn/uploadgambar.php"),
						function(result){
							app.dialog.alert(JSON.stringfy(result));}
							, function(error){
								app.dialog.alert(JSON.stringfy(error));
							} , option);
					
				app.views.main.router.navigate('/kejadiancards/');
					// app.dialog.alert(data);
			  	// app.views.main.router.back('/');
				}
			);

		});
	}
	if(page.name == 'kejadiancards'){

	}
	if(page.name == 'detail_kejadian'){
	}
	if(page.name == 'registration'){
		$$('#btnsubmit').on('click', function() {
			var x = new FormData($$(".input-registrasi")[0]);
			app.request.post('http://192.168.1.55/projectpmn/registrasi.php', x, function (data) {
				console.log(data);
			  	app.dialog.alert(data);
			  	app.views.main.router.back('/');
			});
		});
	}
	if(page.name == 'kejadianlist'){
		$$('#btnLogout').on('click', function(){
			localStorage.removeItem("username");
			mainView.router.navigate('/login/');
		});
	}

});