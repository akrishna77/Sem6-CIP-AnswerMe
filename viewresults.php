
<HTML>
<HEAD>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<script src="http://www.google.com/jsapi?key=ABQIAAAA-gjSvQuhqOTJbxQFzLLZ1BQNLUYCZxEAdi-Rei0D2lPTc5iTBRQKFSx4PKMVxUQY95mqhOif5BPLBA" type="text/javascript"></script>
<script type="text/javascript">google.load('search','1');</script>
<TITLE>AnswerMe</TITLE>
<STYLE>body,input{font:12px Calibri,Arial}#page-wrap{width:900px;text-align:left;height:90%}#logo{font-family:Helvetica,sans-serif}#searchbox{border:3px solid #fe9;font-size:35px;width:450px;-moz-border-radius:5px;font-weight:bold;padding-left:5px}#search-content{display:none}#tweet{text-align:center;width:130px;position:absolute;top:40px;left:80%;display:inline}#footer{text-align:center;font:12px verdana;color:#888;clear:both}.text-label{background-image:url(xreal-time-search.png.pagespeed.ic.45ekxG4Kat.png);background-repeat:no-repeat;background-position:80px 0px}.content{border:0px solid gray;float:left;margin:10px}.content .header{background-color:#fe9;font-size:18px;height:30px;-moz-border-radius:5px;font:bold 18px Cambria;margin:0 -5px 10px -5px;padding:6px 0 0 10px}.content .data{margin-bottom:10px}.content a{font:13px sans-serif}a{color:#0075ca}#image-content img{border:1px solid #ddd;margin:1px;padding:1px}</STYLE>
</HEAD>
<BODY>

<center>


<div id="page-wrap">

<center>

<input type="text" title="Real Time Search" id="searchbox" name="searchbox"/>
<form action="#" method="POST">
<input type="radio" name="rank" value="query1"> Mixed
<input type="radio" name="rank" value="query2"> Transliterated
<input type="radio" name="rank" value="query3"> Meaning
<input type="submit" name="submit" value="submit"> 
</form>
</center>
<br/><br/>
<?php 	
		if(isset($_POST["rank"]))
			$ans = $_POST["rank"];
		else
			$ans = "query3";
		if($ans == "query1") { ?>
		<div class="data" id="web-content1"></div>
		<div class="data" id="web-content2"></div>
		<div class="data" id="web-content3"></div>
<?php } elseif($ans == "query2") { ?>
		<div class="data" id="web-content2"></div>
		<div class="data" id="web-content3"></div>
		<div class="data" id="web-content1"></div>
<?php } else { ?>
		<div class="data" id="web-content3"></div>
		<div class="data" id="web-content1"></div>
		<div class="data" id="web-content2"></div>
<?php } ?>
</div>
</center>

</BODY>
	<SCRIPT>
		//var imageSearch;
		var webSearch1, webSearch2, webSearch3;

		var allResults;
		//var newResultsDiv=document.createElement('div');
		//newResultsDiv.id='web-content';
		var query = ["arvind"];
		//var newsSearch;
		//var blogSearch;
		var lastSearch=0;
		$(function(){
		//	imageSearch=new google.search.ImageSearch();
		//	imageSearch.setSearchCompleteCallback(this,imgSearchComplete,null);
			webSearch1=new google.search.WebSearch();
			webSearch1.setSearchCompleteCallback(this,webSearchComplete,[webSearch1,1]);

			webSearch2=new google.search.WebSearch();
			webSearch2.setSearchCompleteCallback(this,webSearchComplete,[webSearch2,2]);

			webSearch3=new google.search.WebSearch();
			webSearch3.setSearchCompleteCallback(this,webSearchComplete,[webSearch3,3]);
		//	newsSearch=new google.search.NewsSearch();
		//	newsSearch.setSearchCompleteCallback(this,newsSearchComplete,[newsSearch,lastSearch]);
		//	var hash=window.location.hash;
		//	if(hash!=""&&hash.length>0){
		//		if(hash.substr(0,3)=='#q='){
						var searchquery=query[0];
						$('#searchbox').removeClass('text-label').val(searchquery);
						webSearch1.execute(searchquery);

						searchquery=query[1];
						$('#searchbox').removeClass('text-label').val(searchquery);
						webSearch2.execute(searchquery);

						searchquery=query[2];
						$('#searchbox').removeClass('text-label').val(searchquery);
						webSearch3.execute(searchquery);
					//}
			//	}
			//}
			$('#searchbox').focus();
		});
		/*function imgSearchComplete(){if(imageSearch.results&&imageSearch.results.length>0){var contentDiv=document.getElementById('image-content');contentDiv.innerHTML='';var results=imageSearch.results;for(var i=0;i<results.length;i++){var result=results[i];var imgContainer=document.createElement('div');imgContainer.setAttribute("align","left");var newLink=document.createElement('a');newLink.href=result.unescapedUrl
		newLink.target="_new";newLink.title=result.titleNoFormatting;var newImg=document.createElement('img');newImg.src=result.tbUrl;newImg.setAttribute("align","left");newLink.appendChild(newImg);imgContainer.appendChild(newLink);contentDiv.appendChild(imgContainer);}}}*/
		function webSearchComplete(searcher,searchNum){
			var contentDiv=document.getElementById('web-content'+searchNum);
			//contentDiv.innerHTML='';
			var results=searcher.results;
			var newResultsDiv=document.createElement('div');
			for(var i=0;i<results.length;i++){
				var result=results[i];
				var resultHTML='<div style="height:70px; margin-top:5px;">';
				resultHTML+='<a href="'+result.unescapedUrl+'" target="_blank"><b>'+result.titleNoFormatting+'</b></a><br/>'+result.content+'<div/>';
				//newResultsDiv.innerHTML+=resultHTML;
				contentDiv.innerHTML+=resultHTML;
			}
		}
		/*function newsSearchComplete(searcher,searchNum){var contentDiv=document.getElementById('news-content');contentDiv.innerHTML='';var results=searcher.results;var newResultsDiv=document.createElement('div');newResultsDiv.id='news-content';for(var i=0;i<results.length;i++){var result=results[i];var resultHTML='<div style="height:70px; margin-top:5px;">';if(result.image!=undefined){resultHTML='<img align="right" src="'+result.image.tbUrl+'"/>';}
		resultHTML+='<a href="'+result.unescapedUrl+'" target="_blank"><b>'+result.titleNoFormatting+'</b></a><br/>';resultHTML+=result.content+'<br/></div>';newResultsDiv.innerHTML+=resultHTML;}
		contentDiv.appendChild(newResultsDiv);}*/
		$('#searchbox').keyup(function(){var query=$(this).val();search(query);});
		function search(query){
		/*	if(query.length>0){
				$("#search-content").show();
				document.title=query+" | AnswerMe";
				window.location.hash="q="+query;
			}
			else{
				document.title="AnswerMe";
				$("#search-content").hide();
			}*/

		//imageSearch.execute(query);
		//webSearch.execute(query);
		lastSearch++;
		//newsSearch.execute(query);
	}
	
		$('#searchbox').each(function(){$(this).addClass('text-label');$(this).keyup(function(){if(this.value.length==1){$(this).removeClass('text-label');}
		if(this.value==''){$(this).addClass('text-label');}});});
	</SCRIPT>



</HTML>