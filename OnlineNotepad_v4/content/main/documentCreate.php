<form action="?action=aCreateDocument" method="post">
  Title: <input type="text" name="title" >
  <div id="users">
    <div id="user_0">
      Useremail: <input type="text" name="user_0" > <a href="#">X</a>
    </div>
    <button id="addUser" type="button" name="addUser">Add User</button>
  </div>
  <input type="submit" value="Create">
</form>

<script type="text/javascript">
$("#addUser").on("click", function(){
  var countAsString = $("#users").children("div").last().attr("id").split("user_")[1];
  var count = parseInt(countAsString) + 1;
  $("#addUser").before(`<div id="user_` + count + `">
    Useremail: <input type="text" name="user_` + count + `" > <a href="#" onclick="deleteUser(this)">X</a>
  </div>`);
});
  function deleteUser(u){
    console.log(u);
    $(u).parent().remove();
    updateUsers();
  }
  function updateUsers(){
    var users = $("#users");
    users.children("div").each(function(i){
      $(this).attr("id", "user_" + i);
      $(this).children("input").attr("name", "user_" + i)
    });
  }
</script>
