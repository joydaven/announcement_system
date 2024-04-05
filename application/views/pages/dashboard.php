
<nav>
        <div class="nav-wrapper">
        <a href="#" class="brand-logo right"></a>
        <ul id="nav-mobile" class="left hide-on-med-and-down">
            <li><a href="#">My Announcement</a></li>
            <li><a href="<?php echo base_url('index.php/main/logout');?>">Logout</a></li>
        </ul>
        </div>
</nav>
<div class="container" id="container11" style="width:95%">
    <div class="row">
        <div class="col s12 m12">
            <div class="card col s12 m12">
                <div class="card-content">
                    <div class="row">
                        <div class="col s10"><span class="card-title">My Announcement</span></div>
                        <div class="col s2"><a id="btnAddNewAnnouncement" href="#modalAddNewAnnouncement" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a></div>
                        <div class="row">
                    </div>
                    <div class="divider"></div>
                    <div class="row" style="overflow-y:scroll; height:300px;">
                        <div class="col s12">
                            <table class="highlight responsive-table">
                                <thead>
                                <tr>
                                    <th style="width: 20%;">Title</th>
                                    <th style="width: 33%;">Content</th>
                                    <th style="width: 12%;">Start Date</th>
                                    <th style="width: 12%;">End Date</th>
                                    <th style="width: 7%;">Active</th>
                                    <th style="width: 13%;text-align: center;">Action</th>
                                </tr>
                                </thead>
                                <tbody id="listannouncement">
                                    <tr><td colspan="6">  <div class="progress"><div class="indeterminate"></div></div></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="row">
                        <div class="col s12 m12">
                            <!--<ul class="pagination">
                                <li class="active"><a href="#!">1</a></li>
                                <li class="w    aves-effect"><a href="#!">2</a></li>
                                <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
                            </ul>-->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<div id="modalAddNewAnnouncement" class="modal" style="max-height:87%; height:87%;">
    <div class="modal-content">
        <h6><b>New Announcement</b></h6>
        <form class="col s12" method="post" accept-charset="utf-8" id="frmNewAnnouncement">
            <div class="row">
                <div class="input-field col s12">
                    <input id="newATitle" required type="text" name="title" class="validate">
                    <label for="newATitle" data-error="" data-success="">Title</label>
                </div>
                <div class="input-field col s12">
                    <textarea id="newAContent" class="materialize-textarea" data-length="500"></textarea>
                    <label for="newAContent">Content</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" id="newAStartDate" class="datepicker">
                    <label for="newAStartDate" data-error="" data-success="">Start Date</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" id="newAEndDate" class="datepicker">
                    <label for="newAEndDate" data-error="" data-success="">End Date</label>
                </div>
            </div>
        <div class="modal-footer">
            <a href="#!" id="btnsaveNewAnnouncement" class="modal-action waves-effect waves-green btn-large">Save</a>
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a> 
        </div>
        </form> 
    </div>
</div>
<div id="modalEditAnnouncement" class="modal" style="max-height:87%; height:87%;">
    <div class="modal-content">
        <h6><b>Update Announcement</b></h6>
        <form class="col s12" method="post" accept-charset="utf-8" id="frmNewAnnouncement">
            <div class="row">
                <div class="input-field col s12">
                    <input id="upATitle" required type="text" name="title" class="validate active">
                    <label class="active" for="upATitle" data-error="" data-success="" >Title</label>
                </div>
                <div class="input-field col s12">
                    <textarea id="upAContent" class="materialize-textarea" data-length="500"></textarea>
                    <label for="upAContent" class="active">Content</label>
                </div>
                <div class="input-field col s12">
                    <input type="text" id="upAStartDate" class="datepicker">
                    <label for="upAStartDate" data-error="" data-success="" class="active">Start Date</label>
                </div>
                <div class="input-field col s12">
                        <input type="text" id="upAEndDate" class="datepicker">
                        <label for="upAEndDate" data-error="" data-success="" class="active">End Date</label>
                    </div>
                </div>
            <input type="hidden" id="idannouncement">
            <div class="modal-footer">
                <a href="#!" id="btnUpdateAnnouncement" class="modal-action waves-effect waves-green btn-large">Save</a>
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancel</a> 
            </div>
            </div>
        </form> 
    </div>
</div>
<script>
    let base_url='<?php echo base_url();?>';
    let user='<?php echo $this->session->user_id; ?>';
    $(()=>{ 
        listAnnouncement();
        
        $('#btnAddNewAnnouncement').click(()=>{
            $('#modalAddNewAnnouncement').modal('open');
        });
        $('#modalAddNewAnnouncement').modal();
        $('#modalEditAnnouncement').modal();
        $('textarea#newAContent').characterCounter();
        $('.datepicker').datepicker();
        let date2 = new Date();
        date2.setDate(date2.getDate() + 1);
        $('#newAEndDate').datepicker({'defaultDate':date2,setDefaultDate:true,container:'body',minDate:date2});
        $('#newAStartDate').datepicker({
            'defaultDate':new Date(),
            setDefaultDate:true,
            container:'body',
            minDate: new Date(), 
        });

        $('#newAStartDate').on('change',function(){
            let date = new Date($('#newAStartDate').val());
            date.setDate(date.getDate() + 1);
            $('#newAEndDate').datepicker({'defaultDate':new Date(),setDefaultDate:true,container:'body',minDate:date});
        });
        $('#upAStartDate').on('change',function(){
            let date = new Date($('#upAStartDate').val());
            date.setDate(date.getDate() + 1);
            $('#upAEndDate').datepicker({'defaultDate':date,setDefaultDate:true,container:'body',minDate:date});
        });
        $('#btnsaveNewAnnouncement').click(function(e){
            e.preventDefault();
            if(!$('#newATitle').val()){
                M.toast({html: 'Title is Required'}); 
                return;
            }
            if(!$('#newAContent').val()){
                M.toast({html: 'Content is Required'}); 
                return;
            }
            if(!$('#newAStartDate').val()){
                M.toast({html: 'Start Date is Required'}); 
                return;
            }
            if(!$('#newAEndDate').val()){
                M.toast({html: 'End Date Required'}); 
                return;
            }
            $.post( base_url+'index.php/main/saveMyAnnouncement', {'user_id':user,
                'title':$('#newATitle').val(),
                'content':$('#newAContent').val(),
                'startdate':$('#newAStartDate').val(),
                'enddate':$('#newAEndDate').val(),
                },function(data){
                    if(data.msg=='' && data){
                        M.toast({html: 'Successfully Added New Announcement'});
                        listAnnouncement();
                        $('#newATitle').val('');
                        $('#newAContent').val('');
                        $('#newAStartDate').val('');
                        $('#newAEndDate').val('');
                        $('#modalAddNewAnnouncement').modal('close');
                    }else{
                        M.toast({html: data.msg});
                    }
                },'json')
                .fail(function() {
                    M.toast({html: 'Error connection failed'});  
                });
            });
        
        $('#btnUpdateAnnouncement').click(function(e){
            e.preventDefault();
            if(!$('#upATitle').val()){
                M.toast({html: 'Title is Required'}); 
                return;
            }
            if(!$('#upAContent').val()){
                M.toast({html: 'Content is Required'}); 
                return;
            }
            if(!$('#upAStartDate').val()){
                M.toast({html: 'Start Date is Required'}); 
                return;
            }
            if(!$('#upAEndDate').val()){
                M.toast({html: 'End Date Required'}); 
                return;
            }
            $.post( base_url+'index.php/main/updateMyAnnouncement', {'id':$('#idannouncement').val(),
                'title':$('#upATitle').val(),
                'content':$('#upAContent').val(),
                'startdate':$('#upAStartDate').val(),
                'enddate':$('#upAEndDate').val(),
                },function(data){
                    if(data.msg=='' && data){
                        M.toast({html: 'Successfully Updated Announcement'});
                        listAnnouncement();
                        $('#modalEditAnnouncement').modal('close');
                    }else{
                        M.toast({html: data.msg});
                    }
                },'json')
                .fail(function() {
                    M.toast({html: 'Error connection failed'});  
                });
            });
    });
    function listAnnouncement(){
            $.post( base_url+'index.php/main/myAnnouncementList', {'user_id':user},function(data){
            if(data.msg=='' && data){
                //console.log(data);
                let lst='';
                for(let i=0; i<data.list.length; i++){
                    lst+='<tr><td>'+data.list[i].title+'</td>'+
                    '<td><div style="word-wrap: break-word;width: 300px;">'+data.list[i].content+'</div></td>'+
                    '<td>'+formatDate(data.list[i].start_date)+'</td>'+
                    '<td>'+formatDate(data.list[i].end_date)+'</td>'+
                    '<td>'+(data.list[i].active==1?'Yes':'No')+'</td>'+
                    '<td><div class="row"><div class="col s6"><a class="waves-effect waves-light btn" onclick="editAnnouncement('+data.list[i].id+');" style="float:left;"><i class="material-icons">create</i></a></div>'+
                    '<div class="col s6"><a class="waves-effect waves-light btn" onclick="deleteAnnouncement('+data.list[i].id+',\''+data.list[i].title+'\');" style="float:left;"><i class="material-icons">delete_forever</i></a></div></div></td>'+
                    '</tr>';
                }
                lst+='<tr><td colspan="6"><em><center>--end list--</center></em></td></tr>'
                $('#listannouncement').html(lst);
            }else if(data.msg=='Your Announcement is Empty') {
                lst='<tr><td colspan="6"><em><center>--end list--</center></em></td></tr>';
                $('#listannouncement').html(lst);
            }else{
                M.toast({html: data.msg});
            }        
            },'json')
            .fail(function() {
                M.toast({html: 'Error connection failed'});  
            });
    }
    function deleteAnnouncement(i,name){
            if(confirm('Are you sure to delete announcement name '+ name+'?')){
                $.post( base_url+'index.php/main/deleteMyAnnouncement', {'id':i},function(data){                
                        if(data.msg=='' && data){
                            M.toast({html: 'Successfully Deleted <span style="font-weight:bold;">'+ name+'</span>'});
                            listAnnouncement();
                            $('#modalAddNewAnnouncement').modal('close');
                        }else{
                            M.toast({html: data.msg});
                        }
                    },'json')
                    .fail(function() {
                        M.toast({html: 'Error connection failed'});  
                });
            }
    }
    function editAnnouncement(i){
        $.post( base_url+'index.php/main/editMyAnnouncement', {'id':i},function(data){
                console.log(data);           
                        if(data.msg=='' && data){
                            let date2 = new Date(data.list.start_date);
                            date2.setDate(date2.getDate() + 1);
                            $('#upAEndDate').datepicker({'defaultDate':new Date(data.list.end_date),setDefaultDate:true,container:'body',minDate:date2});
                            $('#upAStartDate').datepicker({
                                'defaultDate':new Date(data.list.start_date),
                                setDefaultDate:true,
                                container:'body',
                                minDate: new Date(), 
                            });
                            $('#upATitle').val(data.list.title);
                            $('#upAContent').val(data.list.content);
                            $('#upAStartDate').val(formatDate(data.list.start_date));
                            $('#upAEndDate').val(formatDate(data.list.end_date));
                            $('#idannouncement').val(i);
                            $('label[for="upAContent"]').addClass('active');
                            $('label[for="upATitle"]').addClass('active');
                            $('label[for="upAStartDate"]').addClass('active');
                            $('label[for="upAEndDate"]').addClass('active');
                            //$('#upAEndDate').datepicker({'defaultDate':new Date(data.list.end_date),setDefaultDate:true,container:'body'});
                            //$('#upAStartDate').datepicker({'defaultDate':new Date(data.list.start_date),setDefaultDate:true,container:'body'});
                            $('#modalEditAnnouncement').modal('open');
                        }else{
                            M.toast({html: data.msg});
                        }
                    },'json')
                    .fail(function() {
                        M.toast({html: 'Error connection failed'});  
        });
    }
    function formatDate(date){
        let month = {0: 'Jan', 1: 'Feb', 2: 'Mar', 3: 'Apr', 4: 'May', 5: 'Jun', 6: 'Jul', 7: 'Aug', 8: 'Sep', 9: 'Oct', 10: 'Nov', 11: 'Dec'};
        let dt = new Date(date);
        let newd="";
        newd=month[dt.getMonth()] + " " + dt.getDate() + ", " + dt.getFullYear();
        return newd;
    }
</script>
