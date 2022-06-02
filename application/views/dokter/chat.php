<style type="text/css">
	
.chat-main{
    bottom: 0;
    right: 0px;
    position:;
}
.chat-header{
    background: #1F60A8;
    border:1px solid #fff;
    color: #fff;
    font-family: courier,helvetica;
}
.image img{
    height: 40px;
    width: 40px;
}
.user-detail h6{
    display: inline-block;
}
.user-detail .active{
    color: #32B92D;
    font-size: 12px;
}
.options i{
    color: #fff;
    font-size: 19px;
    cursor: pointer;
}
.chat-content, .chat-content .sender, .user-detail h6{
    font-size: 14px;
    font-family: helvetica;
}
.chat-content ul{
    height: 350px;
    overflow-x: scroll;
    overflow-x: hidden;

}
.chat-content ul li{
    list-style: none;
    background: #F5F5F5;
}
.chat-content .msg-box{
    background: #e1e1e1;
}
.chat-content .msg-box .send-btn{
    background: #007BFF;
}
.chat-content .time{
    font-size: 11px;
    color: #a1a1a1;
}
.avatar{
		align-items: center;
		width: 30px;
		float: left;
}
.file-upload > input{
    display: none;
    cursor: pointer;
}
</style>
    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6 m-0 chat-main">
                <div class="row">
                    <div class="col-md-12 chat-header rounded-top p-2">
                        <div class="row">
                            <div class="col-2 image">
                                <img src="<?php echo $pasien->foto ? base_url('assets/images/users/'.$pasien->foto) : base_url('assets/telemedicine/img/default.png');?>" class="img-rounded" style="border-radius: 50%">
                            </div>
                            <div class="col-7 user-detail pt-2">
                                <h6 class="pt-1"><?php echo ucwords($pasien->name) ?></h6>
                                <i class="fa fa-circle active ml-1" aria-hidden="true"></i>
                            </div>
                            <div class="col-3 options text-right pt-2">
                                <i class="fa fa-ellipsis-h mr-1 hide-chat-box"></i>
                                <!-- <i class="fa fa-times hide-chat-box"></i> -->
                            </div>
                        </div>
                    </div>
                    <!--col-md-12-->
                    <div class="col-md-12  chat-content p-0 bg-white border border-top-0">
                        <ul class="pl-3 pr-3 pt-1 mb-1" id="messages">

                        </ul> 
                        <p class="text-center mb-2 sender font-italic"><?php echo ucwords($user->name) ?></p>
                        <div class="msg-box pt-2">
                        	<div class="container">
					            <div class="form-row">
                                  <div class="col-lg-12">
                                    <div class="input-group mb-2">
                                        <form id="form-message" class="col-lg-12" style="margin-left: 15px" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-9">
                                                    <textarea name="message" class="form-control" placeholder="Type a message ..." style="padding-left: 10px"> </textarea>   
                                                </div>
                                                <div class="col-1">
                                                    <div class="file-upload">
                                                        <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                                                              <div class="btn-group" role="group">
                                                                <label type="file" for="attachment" id="attachment_label" style="padding-top: 10px"><i class="fa fa-paperclip fa-lg" aria-hidden="true"></i></label>
                                                              </div>
                                                            </div>
                                                        <input type="file" id="attachment" name="attachment" accept="application/vnd.openxmlformats-officedocument.wordprocessingml.document, text/plain, image/*">  
                                                    </div>
                                                </div>
                                                <div class="col-2">
                                                    <button type="submit" class="btn btn-primary" id="send"><i class="fa fa-paper-plane"></i></button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-9" id="attachment_name">

                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
					    	</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section>
    <!-- /.content -->
    
<script>

chat_locate = 'dokter';
user_kategori = 'dokter';
id_pasien = <?php echo $this->uri->segment(4) ?>;
id_dokter = <?php echo $user->id ?>

// window.scrollTo(0,document.querySelector("#messages").scrollHeight+100);

</script>