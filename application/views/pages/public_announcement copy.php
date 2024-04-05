<div class="container">
<a class="waves-effect waves-light btn modal-trigger" href="#loginme">Login</a>
<a class="waves-effect waves-light btn modal-trigger" href="#register">Register</a>



  <div id="loginme" class="modal">
    <div class="modal-content">
      <div class="card col s12 m7 center-align" style="margin:auto; width:50%;">
        <h2 class="header">Login</h2>
        <div class="card horizontal">
          <div class="card-image">
          </div>
          <div class="card-stacked">
            <form class="col s12" method="post" accept-charset="utf-8" id="frmlogin">
              <div class="card-content">
                    <div class="row">
                      <div class="input-field col s12">
                        <i class="medium material-icons prefix">account_circle</i>
                        <input id="username_" required type="text" name="username" class="validate">
                        <label for="username_" data-error="" data-success="">Username</label>
                      </div>
                    </div>
                    <div class="row">
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
                    <input type="submit" id="submitlogin" value="Login" class="waves-effect waves-light btn-large">
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  

</div>
<script>
  $(()=>{
    //M.AutoInit();
    $('#loginme').modal();
    
    let base_url='<?php echo base_url('index.php/main/login');?>';
    $('#frmlogin').submit(function(e){
      e.preventDefault();
      //console.log('dd',$('#frmlogin').serialize());
      $.post( base_url, $('#frmlogin').serialize(), function(data){
        if(data.msg!=''){
          $('#submitlogin').addClass('disabled');
          M.toast({html: 'Successfully Login! redirecting to dashboard'});
          setTimeout(() => {
            location.reload();
          }, 1000);
        }else{
          M.toast({html: data.msg});
        }
        console.log(data);
        
      },'json')
      .fail(function() {
        M.toast({html: 'Error connection failed'});  
      });
    });
  });
</script>
  