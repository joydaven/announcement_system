<div class="container" style="width:90%;">
  <div class="row">
    <div class="col s6">
      <h5>Announcement</h5>
    </div>
    <div class="col s6"> 
      <a class="waves-effect waves-light btn modal-trigger" href="#loginme">Login</a>
      <a class="waves-effect waves-light btn modal-trigger" href="#register" id="regme">Register</a>
    </div>
  </div>

  <div class="row" id="allannouncement">
    <div class="progress">
        <div class="indeterminate"></div>
    </div>
  </div>

  <div id="loginme" class="modal bottom-sheet" style="max-height:70%; height:80%;">
          <div class="card">
            <h5 class="header">Login</h5>
            <div class="card horizontal"></div>
            <form class="col s12" method="post" accept-charset="utf-8" id="frmlogin">
              <div class="card-content">
                    <div class="row">
                      <div class="input-field col s12">
                        <i class="medium material-icons prefix">account_circle</i>
                        <input id="username_" required type="text" name="username" class="validate">
                        <label for="username_" data-error="" data-success="">Username</label>
                      </div>
                    
                      <div class="input-field col s12">
                        <i class="medium material-icons prefix">vpn_key</i>
                        <input id="password_" required type="password" name="password" class="validate">
                        <label for="password_" data-error="" data-success="">Password</label>
                      </div>
                    </div>
              </div>
              <div class="card-action">
                <div class="row">
                  <div class="input-field col s12">
                    <input type="submit" id="submitlogin" value="Login" class="waves-effect waves-light btn">
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn">Close</a> 
                  </div>
                </div>
              </div>
            </form>
          </div>
  </div>
  <div id="register" class="modal bottom-sheet" style="max-height:70%; height:80%;">
          <div class="card">
            <h5 class="header">Register</h5>
            <div class="card horizontal"></div>
            <form class="col s12" method="post" accept-charset="utf-8" id="frmRegister">
              <div class="card-content">
                <div class="row">
                  <div class="input-field col s12">
                    <input id="username_r" required type="text" name="username" class="validate">
                    <label for="username_" data-error="" data-success="">Username</label>
                  </div>
                  <div class="input-field col s12">
                    <input id="password_r" required type="password" name="password" class="validate">
                    <label for="password_r" data-error="" data-success="">Password</label>
                  </div>
                  <div class="input-field col s12">
                    <input id="fisrt_name_r" required type="text" name="first_name" class="validate">
                    <label for="fisrt_name_r" data-error="" data-success="">First Name</label>
                  </div>
                  <div class="input-field col s12">
                    <input id="last_name_r" required type="text" name="last_name" class="validate">
                    <label for="last_name_r" data-error="" data-success="">Last Name</label>
                  </div>
                  <div class="input-field col s12">
                    <input id="email_r" type="email" name="email" class="validate">
                    <label for="email_r" data-error="" data-success="">Email</label>
                  </div>
                </div>
              </div>
              <div class="card-action">
                <div class="row">
                  <div class="input-field col s12">
                    <input type="submit" id="submitRegister" value="Register" class="waves-effect waves-light btn">
                    <a href="#!" class="modal-action modal-close waves-effect waves-green btn">Close</a> 
                  </div>
                </div>
              </div>
            </form>
          </div>
  </div>

</div>
<script>
  let base_url='<?php echo base_url();?>';
  $(()=>{
    //M.AutoInit();
    $('#loginme').modal();
    $('#register').modal();
    $('#regme').click(function(e){
      e.preventDefault();
      $('#register').modal('open');
      $('#username_r').focus();
    })
    $('#frmlogin').submit(function(e){
      e.preventDefault();
      
      $.post( base_url+'index.php/main/login', $('#frmlogin').serialize(), function(data){
        console.log(data);
        if(data.msg==''){
          $('#submitlogin').addClass('disabled');
          M.toast({html: 'Successfully Login!, Redirecting now to dashboard'});
          setTimeout(() => {
            location.reload();
          }, 1000);
        }else{
          try{
            M.toast({html: data.msg});
          }catch(e){

          }
          $('#username_').val('');
          $('#password_').val('');
        }
        //console.log(data);
        
      },'json')
      .fail(function() {
        M.toast({html: 'Error connection failed'});  
      });
    });
  });
  $('#frmRegister').submit(function(e){
    e.preventDefault();
    if(!$('#username_r').val()){
      M.toast({html: 'Title is Required'}); 
      return;
    }
    if(!$('#password_r').val()){
      M.toast({html: 'Password Name is Required'}); 
      return;
    }
    if(!$('#fisrt_name_r').val()){
      M.toast({html: 'First Name is Required'}); 
      return;
    }
    if(!$('#last_name_r').val()){
      M.toast({html: 'Last Name is Required'}); 
      return;
    }
    $.post( base_url+'index.php/main/register', $('#frmRegister').serialize(),function(data){

      if(data.msg==''){
        M.toast({html: 'Successfully Registered, Redirecting now to dashboard'});
        $('#username_r').val('');
        $('#password_r').val('');
        $('#fisrt_name_r').val('');
        $('#last_name_r').val('');        
        $('#register').modal('close');
        $('#loginme').modal('open');
        setTimeout(() => {
            location.reload();
          }, 1000);
      }else{
        M.toast({html: data.msg});
      }
    },'json')
    .fail(function() {
      M.toast({html: 'Error connection failed'});  
    });
  });
let isActive = true;
let allannouncement='';
$().ready(function () {
  pollAnnouncement();
});
function pollAnnouncement()
{
    allannouncement='';
    if (isActive)
    {
        window.setTimeout(function () {
        $.ajax({
                url: base_url+'index.php/main/getAllAnnouncement',
                type: "POST",
                dataType: "json",
                success: function (data) {
                  console.log(data);
                  allannouncement="";
                  for(let i=0; i<data.list.length; i++){
                    allannouncement+='<div class="col s12 m12">'+
                    '<div class="card blue-grey darken-1">'+
                    '<div class="card-content white-text">'+
                    '<span class="card-title">'+data.list[i].title+'<span style="float:right; font-size:12pt;">End Date:'+formatDate(data.list[i].end_date)+'</span></span>'+
                    '<span>by: <i class="tiny material-icons center-align prefix">assignment_ind</i><b>'+toProperCase(data.list[i].first_name)+' '+toProperCase(data.list[i].last_name)+'</b> '+data.list[i].date_created+'</span>'+
                    '<p>'+data.list[i].content+'</p>'+
                    '</div>'+
                    '</div>'+
                    '</div>';
                  }
                  $('#allannouncement').html(allannouncement);
                  pollAnnouncement();
                },
                error: function () {
                  pollAnnouncement();
                }});
        }, 2500);
    }
}
function formatDate(date){
        let month = {0: 'Jan', 1: 'Feb', 2: 'Mar', 3: 'Apr', 4: 'May', 5: 'Jun', 6: 'Jul', 7: 'Aug', 8: 'Sep', 9: 'Oct', 10: 'Nov', 11: 'Dec'};
        let dt = new Date(date);
        let newd="";
        newd=month[dt.getMonth()] + " " + dt.getDate() + ", " + dt.getFullYear();
        return newd;
    }
function toProperCase(str){
  let newStr = str.split(' ')
   .map(w => w[0].toUpperCase() + w.substring(1).toLowerCase())
   .join(' ');
   return newStr;
}
</script>
  