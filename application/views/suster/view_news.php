  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>News</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('dokter/Dashboard');?>">Dashboard</a></li>
              <li class="breadcrumb-item active">NEWS</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data News</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Judul</th>
                  <th>Foto</th>
                  <th>Berita</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <?php $no = 0; 
                  foreach ($news as $data) {
                    $no++?>
                    <tr class="odd gradeX">
                      <td><?php echo $no; ?></td>
                      <td><?php echo $data->judul; ?></td>
                      <td><img style="width: 100px; height: auto;" src="<?php echo $data->foto; ?>"></td>
                      <td><textarea rows="2" style="width: 100%; background-color: transparent; resize: none; border: none">
                      <?php echo $data->berita; ?></td>
                      </textarea>
                      <td style="text-align:center;vertical-align:middle;background-color: #007bff" width="7%">
                          <a href="#" style="text-decoration:none;color: #fff" onclick="return confirm('Lihat Data ?')">LIHAT <i class="fa fa-edit fa-fw"></i></a>
                      </td>
                    </tr>
                    <?php }?>
                </tbody>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->