function bulanIndo(bulan) {
  var monthIndo = {
    '1': 'Januari',
    '2': 'Februari',
    '3': 'Maret',
    '4': 'April',
    '5': 'Mei',
    '6': 'Juni',
    '7': 'Juli',
    '8': 'Agustus',
    '9': 'September',
    '10': 'Oktober',
    '11': 'November',
    '12': 'Desember',
  };

  return monthIndo[bulan];
}

function resetTeleModal(that, callback = false) {
  var idName = $(that).parent().parent().parent().parent().prop('id');
  
  $('#' + idName + ' input:text').val('');
  $('#' + idName + ' input:radio').prop('checked', false);
  $('#' + idName + ' input:checkbox').prop('checked', false);
  $('#' + idName + ' textarea').val('');
  $('#' + idName + ' input[type=number]').val('');

  if (callback !== false) {
    callback();
  } else {
    changePratinjau();
  }

  $('#' + idName + ' :input').prop('disabled', false);
}

function kota() {
  getAjaxData(document.URL + '/get_wilayah/kota', {}, set_kota, false);
}

function provinsi() {
  getAjaxData(document.URL + '/get_wilayah/provinsi', {}, set_provinsi, false);
}

function set_kota(results) {
  $( "#alamat_kota" ).autocomplete({
    source: results.data,
    select: function (e, ui) {
        e.preventDefault();
        $("#id_kota").val(ui.item.value);
    },
    focus: function(e, ui) {
        e.preventDefault();
        $("#alamat_kota").val(ui.item.label);
    },
    minLength: 3
  });
}

function set_provinsi(results) {
  $( "#alamat_provinsi" ).autocomplete({
    source: results.data,
    select: function (e, ui) {
        e.preventDefault();
        $("#id_provinsi").val(ui.item.value);
    },
    focus: function(e, ui) {
        e.preventDefault();
        $("#alamat_provinsi").val(ui.item.label);
    },
    minLength: 3
  });
}

function getAjaxData(requestUrl, requestData, callback, showAlert = true) {
  $.ajax({
      method  : 'POST',
      url     : requestUrl,
      data    : requestData,
      beforeSend: function(data) {
        $('#alert-loading-modal').modal('show');
      },
      success: function(data, status, xhr) {
          try {
              var result = JSON.parse(xhr.responseText);

              if (result.status === true) {
                callback(result);
              } else {
                if (showAlert === true) {
                  alert(result.message);
                }
              }
          } catch (e) {
              alert('Request data gagal.');
          }
      },
      error: function(data) {
          alert('Terjadi kesalahan sistem, silahkan hubungi administrator.');
      },
      complete: function(data) {
          $('#alert-loading-modal').modal('hide');
      }
  });
}

function getAjaxMultipart(requestUrl, requestData, callback, showAlert = true) {
  $.ajax({
      method  : 'POST',
      url     : requestUrl,
      data    : requestData,
      contentType: false,
      processData: false,
      beforeSend: function(data) {
        $('#alert-loading-modal').modal('show');
      },
      success: function(data, status, xhr) {
          try {
              var result = JSON.parse(xhr.responseText);

              if (result.status === true) {
                callback(result);
              } else {
                if (showAlert === true) {
                  alert(result.message);
                }
              }
          } catch (e) {
              alert('Request data gagal.');
          }
      },
      error: function(data) {
          alert('Terjadi kesalahan sistem, silahkan hubungi administrator.');
      },
      complete: function(data) {
          $('#alert-loading-modal').modal('hide');
      }
  });
}

alert = function(str) {   
  $('#alert-message').html(str);
  $('#alert-message-modal').modal('show');
}

function confirm(urlDelete, dataDelete, callbackDelete, str, is_ajax = true) {
  $("#dialogConfirmationDelete").text(str);
  $("#dialogConfirmationDelete").dialog({
    autoOpen: true,
    modal: true,
    buttons : {
      "Ya" : function() {
        $(this).dialog("close");

        if (is_ajax === true) {
          getAjaxData(urlDelete, dataDelete, callbackDelete);      
        } else {
          window.location = urlDelete;
        }
      },
      "Tidak" : function() {
        $(this).dialog("close");

        return false;
      }
    }
  });
}

$(document).ready(function(){
  $("#dialogConfirmationDelete").dialog({
    autoOpen: false,
    modal: true,
    buttons : {
      "Ya" : function() {
        $(this).dialog("close");

        return true;           
      },
      "Tidak" : function() {
        $(this).dialog("close");

        return false;
      }
    }
  });
});

$(document).on('show.bs.modal', '.modal', function (event) {
    var except = ['date_tafsiran_persalin'];

    if ($.inArray(event.target.id, except) == -1) {
     // $('#'+event.target.id).data('bs.modal').options.backdrop = false;
     // $('#'+event.target.id).data('bs.modal').options.keyboard = false;
    }
});