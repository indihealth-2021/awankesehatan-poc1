
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">            
            <div class="card-body m-5">
                <table width="100%" class="form">
                                  <tbody>
                                    <tr><td><strong>User Pasien</strong></td></tr>
                                    <tr>
                                          <td>Email</td>
                                          <td>
                                            <p><?php echo $user[0]->email;?></p>                                            
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Username</td>
                                          <td>
                                            <p><?php echo $user[0]->username;?></p> 
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Password</td>
                                          <td>
                                            <p><?php echo $user[0]->password;?></p> 
                                          </td>
                                        </tr>
                                        <tr>
                                          <td>Status Akun</td>
                                          <td>
                                          <p><?php if($user[0]->aktif == 1){
                                            echo "Aktif";
                                            }else{
                                              echo "Tidak Aktif";
                                            }?></p> 
                                            
                                          </td>
                                        </tr>
                                        <tr><td>&nbsp;</td><td>&nbsp;</td></tr> 
                                        <tr><td><Strong>BIO Data</Strong></td></tr>
                                    <tr> 
                                      <td width="35%">Surat Tanda Registrasi (STR)</td>
                                      <td>
                                        <p><?php echo $user[0]->str;?></p> 
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Nama</td>
                                      <td>
                                        <p><?php echo $user[0]->name;?></p>
                                      </td>
                                    </tr>
                                    <tr>
                                      <td>Tempat/Tanggal Lahir</td>
                                      <td>
                                        <p><?php echo $user[0]->lahir_tempat;?>, <?php echo $user[0]->lahir_tanggal;?></p>
                                      </td>
                                    </tr> 
                                    <tr>
                                      <td>Jenis Kelamin</td>
                                      <td>
                                      <p><?php echo $user[0]->jenis_kelamin;?></p>
                                      </td>
                                    </tr>
                                    
                                    <tr>
                                      <td>Jalan</td>
                                      <td>
                                      <p><?php echo $user[0]->alamat_jalan;?></p>
                                      </td>
                                    </tr> 
                                    <tr>
                                      <td>Kelurahan/Desa</td>
                                      <td>
                                      <p><?php echo $user[0]->alamat_kelurahan;?></p>
                                      </td>
                                    </tr> 
                                    <tr>
                                      <td>Kecamatan</td>
                                      <td>
                                      <p><?php echo $user[0]->alamat_kecamatan;?></p>
                                      </td>
                                    </tr> 
                                    <tr>
                                      <td>Kabupaten/Kota</td>
                                      <td>
                                      <p><?php echo $user[0]->alamat_kota;?></p>
                                      </td>
                                    </tr> 
                                    <tr>
                                      <td>Provinsi</td>
                                      <td>
                                      <p><?php echo $user[0]->alamat_provinsi;?></p>
                                      </td>
                                    </tr>                                     
                                    <tr>
                                      <td>No. Telp/HP</td>
                                      <td>
                                      <p><?php echo $user[0]->telp;?></p>
                                      </td>   
                                    </tr> 
                                  </tbody>
                                </table>
                                <div class="float-right">  
                      <a href="<?php echo base_url('admin/Pasien/tampilEditPasien/'.$user[0]->id);?>"><button type="button" class="btn btn-primary">EDIT</button></a>
                      <a href="<?php echo base_url('admin/Pasien');?>"><button type="button" class="btn btn-primary" id="form-close">KEMBALI</button></a>
                </div>
              </form> 
            </div>
            
          </div>
          
        </div>
        
      </div>
      
    </section>
