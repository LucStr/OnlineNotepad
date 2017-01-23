<?php
  global $db;
  $document = $db->getDocumentsById($_GET['documentId'])[0];
  $documentId = $document[0];
  $documentName = $document[1];
  $documentContent = $document[2];
 ?>
 <style>
   #documentNameTextbox{
     display: block;
   }
 </style>
<h1 id=documentNameTitle><?=$documentName?></h1>
<input onfocus="this.select();" id="documentNameTextbox" type="text" value="<?=$documentName?>"></input>
<textarea id="documentContent" name="content" rows="8" cols="80"><?=$documentContent?></textarea>


<script src="./diff_match_patch.js" type="text/javascript"></script>
<script type="text/javascript">
dmp = new diff_match_patch();
function getNew(original, version1, version2){
	var patches = dmp.patch_make(original, version2);
  return dmp.patch_apply(patches, version1)[0];
}
var originalContent = $("#documentContent").text();
  $('#documentNameTextbox').hide();
  $("#documentNameTitle").on('click', function() {
    $("#documentNameTextbox").show();
    $("#documentNameTitle").hide();
    $("#documentNameTextbox").focus();
  })
  $("#documentNameTextbox").on('focusout', function(){
    $("#documentNameTextbox").hide();
    $("#documentNameTitle").text($("#documentNameTextbox").val());
    $("#documentNameTitle").show();
    $.ajax({
      type: "POST",
      url: "?action=aChangeDocumentName",
      data: {documentId : <?=$documentId?>, documentName: $("#documentNameTitle").text()},
    });
  })
  $("#documentContent").on("keypress", function(){
  })
  setInterval(function() {
    var dbVersion;
    $.ajax({
      type: "GET",
      url: "noFrame.php?action=aGetContent&documentId=" + <?=$documentId?>,
      success: function(i){
        dbVersion = i;
        var newtext = getNew(originalContent, dbVersion, $("#documentContent").val());
        $.ajax({
          type: "POST",
          url: "?action=aChangeDocumentContent",
          data: { documentId: <?=$documentId?>, content: newtext},
          success: function(i){console.log("it worked :D")},
          error: function(e){console.log("a error :()"); console.log(e)}
        });
        originalContent = newtext;
        $("#documentContent").val(newtext);
      },
      error: function(e){console.log("a error :("); console.log(e)}
    });
  }, 5000);
  </script>
