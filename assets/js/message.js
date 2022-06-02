chat_id = `${id_dokter}_${id_pasien}`;
function template_message(obj){
    if(!obj.file){
        if(chat_locate == 'dokter'){
            var template_dokter = `
            <div class="chat chat-right">
                <div class="chat-body">
                    <div class="chat-bubble">
                        <div class="chat-content">
                            <p>${obj.text}</p>
                        </div>
                    </div>
                </div>
            </div>
            `;

            var template_pasien = `
            <div class="chat chat-left">
                <div class="chat-avatar">
                    <a href="#" class="avatar">
                        <img alt="Pasien" src="${foto_pasien}" class="img-fluid rounded-circle">
                    </a>
                </div>
                <div class="chat-body">
                    <div class="chat-bubble">
                        <div class="chat-content">
                            <p>${obj.text}</p>
                        </div>
                    </div>
                </div>
            </div>
            `;  
        }
        else{
            var template_pasien = `
            <div class="chat chat-right">
                <div class="chat-body">
                    <div class="chat-bubble">
                        <div class="chat-content">
                            <p>${obj.text}</p>
                        </div>
                    </div>
                </div>
            </div>
            `;

            var template_dokter = `
            <div class="chat chat-left">
                <div class="chat-avatar">
                    <a href="#" class="avatar">
                        <img alt="Dokter" src="${foto_dokter}" class="img-fluid rounded-circle">
                    </a>
                </div>
                <div class="chat-body">
                    <div class="chat-bubble">
                        <div class="chat-content">
                            <p>${obj.text}</p>
                        </div>
                    </div>
                </div>
            </div>  
            `;  
        } 
    }
    else{
        if(chat_locate == 'dokter'){
            // var template_dokter = `
            // <div class="row">
            // <span class="col-sm-4 col-4"></span>
            // <li class="p-2 mb-2 rounded text-white col-sm-8 col-8" style="background:#007BFF">
            //     <!-- <span class="float-right time text-white">12:10</span> -->
            //     <p class="m-0">${obj.text}</p>
            //     <a href="${baseUrl}assets/files/attachments/${chat_id}/${obj.file}" target="_blank" class="m-0 text-dark bg-default"><i class="fa fa-paperclip"></i> ${obj.file}</a>
            // </li>
            // `;
            var template_dokter = `
            <div class="chat chat-right">
                <div class="chat-body">
                    <div class="chat-bubble">
                        <div class="chat-content">
                            <p>${obj.text}</p>
                            <a href="${baseUrl}assets/files/attachments/${chat_id}/${obj.file}" target="_blank" class="m-0 text-dark bg-default"><i class="fa fa-paperclip"></i> ${obj.file}</a>
                        </div>
                    </div>
                </div>
            </div>
            `;

            var template_pasien = `
            <div class="chat chat-left">
                <div class="chat-avatar">
                    <a href="#" class="avatar">
                        <img alt="Pasien" src="${foto_pasien}" class="img-fluid rounded-circle">
                    </a>
                </div>
                <div class="chat-body">
                    <div class="chat-bubble">
                        <div class="chat-content">
                            <p>${obj.text}</p>
                            <a href="${baseUrl}assets/files/attachments/${chat_id}/${obj.file}" target="_blank" class="m-0 text-dark bg-default"><i class="fa fa-paperclip"></i> ${obj.file}</a>
                        </div>
                    </div>
                </div>
            </div>
            `;  
        }
        else{
            var template_pasien = `
            <div class="chat chat-right">
                <div class="chat-body">
                    <div class="chat-bubble">
                        <div class="chat-content">
                            <p>${obj.text}</p>
                            <a href="${baseUrl}assets/files/attachments/${chat_id}/${obj.file}" target="_blank" class="m-0 text-dark bg-default"><i class="fa fa-paperclip"></i> ${obj.file}</a>
                        </div>
                    </div>
                </div>
            </div>
            `;

            var template_dokter = `
            <div class="chat chat-left">
                <div class="chat-avatar">
                    <a href="#" class="avatar">
                        <img alt="Pasien" src="${foto_dokter}" class="img-fluid rounded-circle">
                    </a>
                </div>
                <div class="chat-body">
                    <div class="chat-bubble">
                        <div class="chat-content">
                            <p>${obj.text}</p>
                            <a href="${baseUrl}assets/files/attachments/${chat_id}/${obj.file}" target="_blank" class="m-0 text-dark bg-default"><i class="fa fa-paperclip"></i> ${obj.file}</a>
                        </div>
                    </div>
                </div>
            </div>    
            `;  
        }
    }
    


    if(obj.type == 'pasien'){
        return template_pasien;
    }
    else{
        return template_dokter;
    }
}

$(document).ready(function(){
    $('input[name="attachment"]').on('change', function(){ 
            var exts = ['jpg','jpeg','png','txt','docx','doc','pdf','jfif'];

            var file_attachment = $('input[name="attachment"]').val();
            if(file_attachment != ''){
                file_attachment = file_attachment.replace(/^.*\\/, "");
                file_attachment = file_attachment.replace(/\s/g, "_");
                file_attachment = file_attachment.replace(/-/g, '_');
                file = file_attachment.split('.');
                ekstensi = file.pop();
                ekstensi = ekstensi.toLowerCase();
                file = file.join('_');
                file = file.replace(/[^A-Z0-9]+/ig, "_");
                console.log(ekstensi);
                file_attachment = file+'.'+ekstensi;
            }
            if(!exts.includes(ekstensi)){
                $('#attachment_name').empty();
                $('#form-message').trigger("reset");
                $('#attachment_label i').removeClass('text-primary');
                alert('Ekstensi dilarang!');
            }
            else{
                $('#attachment_label i').removeClass('text-primary').addClass('text-primary');
                $('#attachment_name').empty().append('<i class="fa fa-paperclip"></i> '+file_attachment);
            }
     });

    firebase.auth().signInAnonymously().catch(function(error) {
    // Handle Errors here.
        var errorCode = error.code;
        var errorMessage = error.message;
    // ...
    });
    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
        // User is signed in.
        var isAnonymous = user.isAnonymous;
        var uid = user.uid;
        firebase.database()
        .ref(`/chats/${id_dokter}_${id_pasien}`)
        .on('child_added', function(snapshot){
            console.log(snapshot.val());
            $('#messages').append(template_message(snapshot.val()));
            $('.chat-wrap-inner').scrollTop($(".chat-wrap-inner")[0].scrollHeight);
        });

        $('#send').click(function(e){
            e.preventDefault();
            var chatForm = $('#form-message')[0];
            var message = $('textarea[name="message"]').val();
            var file_attachment = $('input[name="attachment"]').val();
            if(file_attachment != ''){
                file_attachment = file_attachment.replace(/^.*\\/, "");
                file_attachment = file_attachment.replace(/\s/g, "_");
                file_attachment = file_attachment.replace(/-/g, '_');
                file = file_attachment.split('.');
                ekstensi = file.pop();
                ekstensi = ekstensi.toLowerCase();
                file = file.join('_');
                file = file.replace(/[^A-Z0-9]+/ig, "_");
                console.log(ekstensi);
                file_attachment = file+'.'+ekstensi;
            }
            if (!message.replace(/\s/g, '').length) {
                alert('Pesan tidak boleh kosong!');
            }
            else{
                firebase.database()
                .ref(`/chats/${id_dokter}_${id_pasien}`)
                .push({
                    type: user_kategori,
                    text: $('textarea[name="message"]').val(),
                    file: file_attachment,
                });
                if(file_attachment != ''){
                    var data_message = new FormData();
                    data_message.append('attachment', $('input[name=attachment]')[0].files[0], file_attachment);
                    $.ajax({
                        method : 'POST',
                        url    : baseUrl+"FileAttachment/upload/"+chat_id,
                        data   : data_message,
                        processData : false,
                        contentType : false,
                        success : function(data){
                            console.log(data);             
                        },
                        error : function(data){
                            alert('Terjadi kesalahan sistem, silahkan hubungi administrator.');
                        }
                    });
                }
                if(chat_locate == 'dokter'){
                    $.ajax({
                        method : 'POST',
                        url    : baseUrl+"dokter/Chat/send_notif",
                        data   : {id_pasien:id_pasien},
                        success : function(data){
                            console.log(data);
                        },
                        error : function(data){
                            alert('Terjadi kesalahan sistem, silahkan hubungi administrator.');
                        }
                    });                    
                }
                else{
                    $.ajax({
                        method : 'POST',
                        url    : baseUrl+"pasien/Chat/send_notif",
                        data   : {id_dokter:id_dokter},
                        success : function(data){
                            console.log(data);
                        },
                        error : function(data){
                            alert('Terjadi kesalahan sistem, silahkan hubungi administrator.');
                        }
                    });
                }
                $('#attachment_label i').removeClass('text-primary');
                $('#form-message').trigger("reset");
                $('#attachment_name').empty();
            }
        })
    // ...
    } // else {
    //     // User is signed out.
    //     // ...
    //   }
    // ...
    });
});