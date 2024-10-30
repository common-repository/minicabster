var minicabster_url = "https://minicabster.co.uk";
var minicabster_domain = minicabster_url+'/widget/';
var minicabster_para="?";
if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
	minicabster_domain=minicabster_domain.replace("www.","m.");
}
if(typeof minicabster!="undefined"){if(typeof minicabster.affid!="undefined")minicabster_para+="affid="+minicabster.affid;if(minicabster_para!="?")minicabster_para+="&";if(typeof minicabster.token!="undefined")minicabster_para+="token="+minicabster.token;if(minicabster_para!="?")minicabster_para+="&";if(typeof minicabster.cabid!="undefined")minicabster_para+="cabid="+minicabster.cabid;ifframe='<iframe src="'+minicabster_domain+minicabster_para+'" ';if(typeof minicabster.width!="undefined")ifframe+='width="'+minicabster.width+'" ';else ifframe+='width="290" ';if(typeof minicabster.height!="undefined")ifframe+='height="'+minicabster.height+'" ';else	ifframe+='height="560" ';ifframe+='style="border:none; outline:none;"></iframe>';}else ifframe='<iframe src="'+minicabster_domain+minicabster_para+'" width="290" height="560" style="border:none; outline:none;"></iframe>';
document.getElementById("minicabster_widget_plugin_box").innerHTML=ifframe;