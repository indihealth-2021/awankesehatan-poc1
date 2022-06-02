<!-- Main content -->
    <div class="page-wrapper">
  <div class="content">
      <div class="row mb-3">
          <div class="col-sm-12 col-12 ">
            <!-- <nav aria-label="">
                <ol class="breadcrumb" style="background-color: transparent;">
                    <li class="breadcrumb-item active"><a href="<?php echo base_url('admin/admin');?>"class="text-black">Dashboard</a></li>
                    <li class="breadcrumb-item" aria-current="page"><b>User Management</b></li>
                </ol>
            </nav> -->
            <p class="font-18">Hallo,</p>
            <p class="font-24">Selamat Datang, <?php echo $user->name ?></p>
          </div>
          <div class="col-sm-12 col-12">
              <h3 class="page-title">Dashboard</h3>
          </div>
      </div>            
            <!-- <h4>Manage Data</h4>
                <hr> -->
          <div class="row">
          <div class="mx-auto">
            <!-- small box -->
            <div class="small-box bg-white">
            <a href="<?php echo base_url('admin/admin/manage_admin') ?>">
              <div class="inner" style="padding: 13px">
                <p class="font-18 font-bold-7">Admin</p>
                <div class="d-inline-flex mt-3">
                  <p class="text-black" style="font-size: 36px;"><?php echo $jml_admin ?></p>
                  <p class="px-2 pt-2 text-black font-14">Admin</p>
                </div>
                
              </div>
              <div class="icon-admin">
                <!-- <i class="fas fa-user-cog"></i> -->
                <i><svg xmlns="http://www.w3.org/2000/svg" width="85" height="auto" viewBox="0 0 84 84" fill="none">
                  <path d="M34.23 33.3667C41.962 33.3667 48.23 27.0987 48.23 19.3667C48.23 11.6347 41.962 5.3667 34.23 5.3667C26.498 5.3667 20.23 11.6347 20.23 19.3667C20.23 27.0987 26.498 33.3667 34.23 33.3667Z" fill="black" fill-opacity="0.05"/>
                  <path d="M38.3598 74.2466C37.5887 73.484 37.0856 72.492 36.9257 71.4193C36.7659 70.3466 36.9579 69.251 37.4732 68.2966L38.7098 65.9633L36.1665 65.1933C35.1294 64.8687 34.2264 64.2146 33.5948 63.3303C32.9631 62.4459 32.6372 61.3797 32.6665 60.2933V55.51C32.6645 54.4284 33.0106 53.3749 33.6534 52.5051C34.2963 51.6353 35.202 50.9954 36.2365 50.68L38.7798 49.91L37.5665 47.5766C37.0664 46.6353 36.8761 45.5602 37.0227 44.5044C37.1694 43.4486 37.6455 42.466 38.3832 41.6966C36.5881 41.4613 34.7802 41.3366 32.9698 41.3233C27.6226 41.1974 22.3134 42.2531 17.4211 44.4149C12.5287 46.5767 8.17362 49.7915 4.6665 53.83V71.9133C4.6665 72.5321 4.91234 73.1256 5.34992 73.5632C5.78751 74.0008 6.381 74.2466 6.99984 74.2466H38.3598Z" fill="black" fill-opacity="0.05"/>
                  <path d="M78.6338 54.74L73.9671 53.34C73.6437 52.1876 73.1897 51.0759 72.6138 50.0267L74.9471 45.6867C75.0373 45.5256 75.0703 45.3387 75.0406 45.1565C75.0109 44.9743 74.9204 44.8075 74.7838 44.6833L71.4004 41.2767C71.2701 41.1498 71.104 41.0661 70.9245 41.0369C70.745 41.0077 70.5609 41.0344 70.3971 41.1133L66.0804 43.4467C65.0179 42.8695 63.9001 42.4004 62.7438 42.0467L61.3204 37.38C61.2578 37.2079 61.1434 37.0595 60.993 36.955C60.8426 36.8506 60.6636 36.7952 60.4804 36.7967H55.6271C55.4452 36.8017 55.2692 36.8627 55.1231 36.9712C54.977 37.0797 54.8678 37.2306 54.8104 37.4033L53.4104 42.07C52.2317 42.4129 51.0965 42.8905 50.0271 43.4933L45.8038 41.16C45.6396 41.0727 45.4521 41.0393 45.2679 41.0644C45.0836 41.0895 44.9119 41.172 44.7771 41.3L41.3471 44.66C41.2121 44.7901 41.1231 44.9608 41.0936 45.146C41.0641 45.3312 41.0958 45.521 41.1838 45.6867L43.5171 49.9333C42.892 50.9873 42.3835 52.1061 42.0004 53.27L37.3338 54.6933C37.1572 54.7444 37.0023 54.8519 36.8927 54.9994C36.7832 55.1469 36.725 55.3263 36.7271 55.51V60.2933C36.725 60.4771 36.7832 60.6564 36.8927 60.8039C37.0023 60.9515 37.1572 61.059 37.3338 61.11L42.0004 62.5333C42.3502 63.6761 42.8195 64.7789 43.4004 65.8233L41.0671 70.2567C40.9791 70.4223 40.9475 70.6121 40.9769 70.7973C41.0064 70.9826 41.0954 71.1532 41.2304 71.2833L44.7071 74.6667C44.8419 74.7947 45.0136 74.8771 45.1979 74.9022C45.3821 74.9274 45.5696 74.8939 45.7338 74.8067L50.0971 72.4733C51.1355 73.0318 52.2306 73.4777 53.3638 73.8033L54.7638 78.5867C54.8225 78.7631 54.9352 78.9166 55.0859 79.0255C55.2367 79.1343 55.4178 79.1931 55.6038 79.1933H60.3871C60.569 79.1882 60.745 79.1273 60.8911 79.0188C61.0372 78.9102 61.1464 78.7594 61.2038 78.5867L62.6038 73.8033C63.7234 73.4817 64.8035 73.0356 65.8238 72.4733L70.2338 74.8067C70.398 74.8939 70.5854 74.9274 70.7697 74.9022C70.9539 74.8771 71.1256 74.7947 71.2604 74.6667L74.6671 71.2833C74.7952 71.1485 74.8776 70.9768 74.9027 70.7926C74.9278 70.6083 74.8944 70.4209 74.8071 70.2567L72.4738 65.87C73.0319 64.8478 73.4779 63.7682 73.8038 62.65L78.4705 61.2267C78.6458 61.1703 78.7998 61.062 78.9123 60.9162C79.0248 60.7704 79.0904 60.5939 79.1005 60.41V55.58C79.1061 55.4108 79.0657 55.2433 78.9835 55.0953C78.9013 54.9474 78.7804 54.8245 78.6338 54.74ZM58.0304 65.7533C56.4881 65.7579 54.979 65.3048 53.6944 64.4513C52.4097 63.5977 51.4072 62.3822 50.8137 60.9586C50.2203 59.5349 50.0626 57.9672 50.3607 56.4539C50.6588 54.9406 51.3991 53.5498 52.4881 52.4576C53.5771 51.3653 54.9657 50.6208 56.4781 50.3182C57.9905 50.0156 59.5587 50.1685 60.9841 50.7577C62.4095 51.3469 63.628 52.3457 64.4854 53.6278C65.3428 54.9099 65.8004 56.4176 65.8004 57.96C65.8005 60.0229 64.9826 62.0016 63.5261 63.4625C62.0696 64.9233 60.0933 65.7472 58.0304 65.7533Z" fill="black" fill-opacity="0.05"/>
                  </svg></i>
              </div>
              </a>
              <!-- <a href="<?php echo base_url('admin/admin/manage_admin') ?>" class="small-box-footer">Manage <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="mx-auto">
            <!-- small box -->
            <div class="small-box bg-white">
            <a href="<?php echo base_url('admin/dokter') ?>">
              <div class="inner" style="padding: 13px">
                <p class="font-18 font-bold-7">Dokter</p>
                <div class="d-inline-flex mt-3">
                  <p class="text-black" style="font-size: 36px;"><?php echo $jml_dokter; ?></p>
                  <p class="px-2 pt-2 text-black font-14">Dokter</p>
                </div>
              </div>
              <div class="icon">
                <i><svg xmlns="http://www.w3.org/2000/svg" width="65" height="auto" viewBox="0 0 73 84" fill="none">
                <path d="M68.5004 59.325C63.2504 49.35 58.0004 50.925 52.2254 50.4C52.7504 51.975 52.7504 53.55 52.7504 55.65C61.1504 57.75 63.2504 67.725 63.2504 73.5V78.75H52.7504V73.5H58.0004C58.0004 73.5 58.0004 60.375 50.1254 60.375C42.2504 60.375 42.2504 72.975 42.2504 73.5H47.5004V78.75H37.0004V73.5C37.0004 67.725 39.1004 57.225 47.5004 55.65C47.5004 52.5 46.9754 49.875 46.4504 48.825C45.4004 48.3 44.3504 47.25 44.3504 45.675C44.3504 42.525 48.5504 43.575 51.7004 37.8C51.7004 37.8 56.4254 25.725 54.8504 15.225H49.6004C49.6004 14.175 50.1254 13.65 50.1254 12.6C50.1254 11.55 50.1254 11.025 49.6004 9.975H53.8004C52.2254 4.725 46.9754 0 37.0004 0C27.0254 0 21.7754 4.725 19.6754 10.5H23.8754C23.8754 11.55 23.3504 12.075 23.3504 13.125C23.3504 14.175 23.3504 14.7 23.8754 15.75H18.6254C17.5754 26.25 21.7754 38.325 21.7754 38.325C24.9254 43.575 29.1254 42.525 29.1254 46.2C29.1254 48.825 26.5004 49.875 23.3504 50.4C22.3004 51.45 21.2504 53.55 21.2504 57.75V64.05C24.4004 65.1 26.5004 68.25 26.5004 71.4C26.5004 75.075 22.8254 78.75 18.6254 78.75C14.4254 78.75 10.7504 75.075 10.7504 70.875C10.7504 67.2 12.8504 64.575 16.0004 63.525V57.225C16.0004 54.6 16.5254 52.5 17.0504 50.4C13.3754 50.925 9.17539 52.5 5.50039 59.325C2.35039 65.1 0.775391 84 0.775391 84H72.7004C73.2254 84 71.6504 65.1 68.5004 59.325ZM29.1254 13.125C29.1254 8.925 32.8004 5.25 37.0004 5.25C41.2004 5.25 44.8754 8.925 44.8754 13.125C44.8754 17.325 41.2004 21 37.0004 21C32.8004 21 29.1254 17.325 29.1254 13.125Z" fill="black" fill-opacity="0.05"/>
                </svg></i>
                <!-- <i class="fas fa-user-md"></i> -->
              </div>
              </a>
              <!-- <a href="<?php echo base_url('admin/dokter') ?>" class="small-box-footer">Manage <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="mx-auto">
            <!-- small box -->
            <div class="small-box bg-white">
            <a href="<?php echo base_url('admin/pasien') ?>">
              <div class="inner" style="padding: 13px">
                <p class="font-18 font-bold-7">Pasien</p>
                <div class="d-inline-flex mt-3">
                  <p class="text-black" style="font-size: 36px;"><?php echo $jml_pasien; ?></p>
                  <p class="px-2 pt-2 text-black font-14">Pasien</p>
                </div>
              </div>
              <div class="icon">
                <!-- <i class="fa fa-wheelchair"></i> -->
                <i><svg xmlns="http://www.w3.org/2000/svg" width="67" height="auto" viewBox="0 0 74 80" fill="none">
                  <path d="M31.9507 15.4781C36.0168 15.4781 39.3131 12.2239 39.3131 8.20963C39.3131 4.19537 36.0168 0.941162 31.9507 0.941162C27.8846 0.941162 24.5884 4.19537 24.5884 8.20963C24.5884 12.2239 27.8846 15.4781 31.9507 15.4781Z" fill="black" fill-opacity="0.05"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M62.1425 74.8167C61.3398 74.8166 60.5497 74.6169 59.8433 74.2357C59.1369 73.8545 58.5364 73.3036 58.0957 72.6327L51.8105 60.2254H29.4962C28.8518 60.2215 28.2146 60.0908 27.6207 59.8406C27.0269 59.5904 26.4882 59.2257 26.0353 58.7674C25.5825 58.309 25.2243 57.7659 24.9814 57.1691C24.7384 56.5723 24.6153 55.9335 24.6192 55.2892V25.9633C24.6192 23.2308 26.8032 21.032 29.4962 21.032C32.1792 21.032 34.3682 23.2308 34.3682 25.9633V50.3579H54.4096C56.0352 50.3579 57.5522 51.1732 58.4465 52.5419L63.8028 63.536L67.0343 62.2117C67.6082 61.9229 68.2339 61.7511 68.8748 61.7064C69.5158 61.6618 70.1592 61.7451 70.7676 61.9516C71.3761 62.1581 71.9373 62.4836 72.4187 62.9092C72.9001 63.3347 73.2919 63.8518 73.5715 64.4303C74.1477 65.5996 74.2406 66.9486 73.83 68.1858C73.4195 69.423 72.5385 70.4488 71.3776 71.0416L64.3068 74.2979C63.6369 74.6405 62.8949 74.8184 62.1425 74.8167Z" fill="black" fill-opacity="0.05"/>
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M26.4714 79.8714C11.9641 79.8714 0.164551 68.0917 0.164551 53.619C0.164551 45.0905 4.33984 37.066 11.3316 32.1446C11.686 31.8944 12.0862 31.7165 12.5094 31.6213C12.9327 31.5261 13.3705 31.5153 13.7979 31.5897C14.2253 31.6641 14.6338 31.8221 15 32.0547C15.3662 32.2873 15.6829 32.5899 15.9318 32.9451C16.1822 33.2988 16.3603 33.6984 16.4558 34.121C16.5514 34.5437 16.5625 34.981 16.4886 35.408C16.4147 35.835 16.2572 36.2431 16.0251 36.6091C15.7931 36.975 15.491 37.2915 15.1363 37.5404C12.5564 39.3545 10.4503 41.762 8.99531 44.5601C7.54033 47.3583 6.77914 50.4652 6.77584 53.619C6.78762 58.8357 8.86856 63.8347 12.562 67.5188C16.2554 71.203 21.2596 73.2714 26.4763 73.27C31.9116 73.27 36.9664 71.1107 40.7316 67.1924C41.3377 66.5607 42.1699 66.1957 43.0451 66.1777C43.9203 66.1596 44.7669 66.4899 45.3985 67.096C46.0302 67.7021 46.3952 68.5343 46.4133 69.4096C46.4313 70.2848 46.101 71.1313 45.4949 71.763C43.0419 74.3369 40.0897 76.3835 36.8188 77.7777C33.5478 79.1718 30.027 79.8843 26.4714 79.8714Z" fill="black" fill-opacity="0.05"/>
                  </svg></i>
              </div>
              </a>
              <!-- <a href="<?php echo base_url('admin/pasien') ?>" class="small-box-footer">Manage <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="mx-auto">
            <!-- small box -->
            <div class="small-box bg-white">
            <a href="<?php echo base_url('admin/Config/poli') ?>">
              <div class="inner" style="padding: 13px">
                <p class="font-18 font-bold-7">Poli</p>
                <div class="d-inline-flex mt-3">
                  <p class="text-black" style="font-size: 36px;"><?php echo count($list_poli); ?></p>
                  <p class="px-2 pt-2 text-black font-14">Poli</p>
                </div>
              </div>
              <div class="icon">
                <!-- <i class="fa fa-plus-square"></i> -->
                <i><svg xmlns="http://www.w3.org/2000/svg" width="65" height="80" viewBox="0 0 64 64" fill="none">
                    <path d="M56.5 0.5H7.5C3.65 0.5 0.535 3.65 0.535 7.5L0.5 56.5C0.5 60.35 3.65 63.5 7.5 63.5H56.5C60.35 63.5 63.5 60.35 63.5 56.5V7.5C63.5 3.65 60.35 0.5 56.5 0.5ZM49.5 39H39V49.5C39 51.425 37.425 53 35.5 53H28.5C26.575 53 25 51.425 25 49.5V39H14.5C12.575 39 11 37.425 11 35.5V28.5C11 26.575 12.575 25 14.5 25H25V14.5C25 12.575 26.575 11 28.5 11H35.5C37.425 11 39 12.575 39 14.5V25H49.5C51.425 25 53 26.575 53 28.5V35.5C53 37.425 51.425 39 49.5 39Z" fill="black" fill-opacity="0.05"/>
                    </svg></i>
              </div>
              </a>
              <!-- <a href="<?php echo base_url('admin/Config/poli') ?>" class="small-box-footer">Manage <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="mx-auto">
            <!-- small box -->
            <div class="small-box bg-white">
            <a href="<?php echo base_url('admin/Obat/manage_obat') ?>">
              <div class="inner" style="padding: 13px">
                <p class="font-18 font-bold-7">Obat</p>
                <div class="d-inline-flex mt-3">
                  <p class="text-black" style="font-size: 36px;"><?php echo $jml_obat > 99 ? '>99':$jml_obat ?></p>
                  <p class="px-2 pt-2 text-black font-14">Obat</p>
                </div>
              </div>
              <div class="icon">
                <!-- <i class="fas fa-prescription-bottle-alt"></i> -->
                <i><svg xmlns="http://www.w3.org/2000/svg" width="65" height="75" viewBox="0 0 56 70" fill="none">
                  <path d="M45.5 10.5V17.5C48.2848 17.5 50.9555 18.6062 52.9246 20.5754C54.8938 22.5445 56 25.2152 56 28V66.5C56 67.4283 55.6313 68.3185 54.9749 68.9749C54.3185 69.6313 53.4283 70 52.5 70H3.5C2.57174 70 1.6815 69.6313 1.02513 68.9749C0.36875 68.3185 0 67.4283 0 66.5V28C0 25.2152 1.10625 22.5445 3.07538 20.5754C5.04451 18.6062 7.71523 17.5 10.5 17.5V10.5H45.5ZM31.5 31.5H24.5V38.5H17.5V45.5H24.4965L24.5 52.5H31.5L31.4965 45.5H38.5V38.5H31.5V31.5ZM52.5 0V7H3.5V0H52.5Z" fill="black" fill-opacity="0.05"/>
                  </svg></i>
              </div>
              </a>
              <!-- <a href="<?php echo base_url('admin/Config/poli') ?>" class="small-box-footer">Manage <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
                <!-- <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget"><a href="<?php echo base_url('admin/admin/manage_admin') ?>">
                                <span class="dash-widget-bg5"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                                <div class="dash-widget-info text-right">
                                    <span class="widget-title5">Admin <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div></a>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget"><a href="<?php echo base_url('admin/dokter') ?>">
                                <span class="dash-widget-bg5"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                                  <div class="dash-widget-info text-right">
                                    <span class="widget-title5">Dokter <i class="fa fa-check" aria-hidden="true"></i></span>
                                  </div>
                            </div></a>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget"><a href="<?php echo base_url('admin/pasien') ?>">
                                <span class="dash-widget-bg5"><i class="fa fa-wheelchair"></i></span>
                                <div class="dash-widget-info text-right">
                                    <span class="widget-title5">Pasien <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div></a>
                        </div>
                        <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget"><a href="<?php echo base_url('admin/Config/poli') ?>">
                                <span class="dash-widget-bg5"><i class="fa fa-plus-square"></i></span>
                                <div class="dash-widget-info text-right">
                                    <span class="widget-title5">Poli <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div></a>
                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                            <div class="dash-widget"><a href="">
                                <span class="dash-widget-bg5"><i class="fa fa-newspaper-o"></i></span>
                                <div class="dash-widget-info text-right">
                                    <span class="widget-title5">Berita <i class="fa fa-check" aria-hidden="true"></i></span>
                                </div>
                            </div></a>
                        </div>
                        -->
                        </div>
                    <div class="row py-5">
                    <div class="col-12 col-md-6 col-lg-7 col-xl-7 mb-5">
                        <div class="">
                            <div style="color: #59A799;">
                                <h4 class="font-tosca d-inline-block">Pasien Baru </h4> <a href="<?php echo base_url('admin/pasien') ?>" style="color: #59A799;" class="float-right">Lihat Semua</a>
                            </div>
                            <div class="mb-3">
                                <div class="table-responsive">
                                    <table class="table mb-0 new-patient-table">
                                        <tbody>
                                        <?php foreach($list_pasien as $pasien){ ?>
                                            <tr>
                                                <td>
                                                    <div><img width="49" height="49" class="rounded-circle" src="<?php echo $pasien->foto;?>" alt=""> </div>
                                                    <div class="ml-5 pl-2 mb-2" style="margin-top:-40px;"><?php echo strlen($pasien->name) > 15 ? '<span title="'.ucwords($pasien->name).'">'.ucwords(substr($pasien->name, 0, 10)).'</span>':ucwords($pasien->name) ?></div>
                                                </td>
                                                <td style="vertical-align: middle!important;"><?php echo $pasien->email ?></td>
                                                <td style="vertical-align: middle!important;"><?php echo $pasien->telp ?></td>
                                                <!-- <td><a href="<?php echo base_url('admin/Pasien/tampilEditPasien/'.$pasien->id);?>"><button class="btn btn-primary btn-primary-one float-right">Edit</button></a></td> -->
                                                <td style="vertical-align: middle!important;"><a class="border-bottom" href="<?php echo base_url('admin/Pasien/tampilEditPasien/'.$pasien->id);?>"><i class="fas fa-pen font-16"></i></a></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-5 col-xl-5">
                        <div class="">
                            <div style="color: #59A799;">
                                <h4 class="font-tosca d-inline-block">Dokter </h4> <a href="<?php echo base_url('admin/dokter') ?>" class="float-right" style="color: #59A799;">Lihat Semua</a>
                            </div>
                            <div class=" mb-3">
                                <div class="table-responsive">
                                    <table class="table mb-0 dokter-table">
                                        <tbody>
                                        <?php foreach($list_dokter as $dokter){ ?>
                                            <tr>
                                                <td>
                                                    <img width="49" height="49" class="rounded-circle" src="<?php echo $dokter->foto;?>" alt=""> 
                                                    <div class="ml-5 pl-2 mb-2" style="margin-top:-45px;" ><span class="font-14"><?php echo strlen($dokter->name) > 32 ? '<span title="'.ucwords($dokter->name).'">'.ucwords(substr($dokter->name, 0, 32)).'...</span>':ucwords($dokter->name) ?></span><br>
                                                    <span class="font-12"><?php echo $dokter->poli_aktif ? strtoupper($dokter->poli):'<font color="red" title="POLI TIDAK AKTIF">'.strtoupper($dokter->poli).'</font>' ?></span></div>
                                                </td>
                                                <td class="font-12 text-center" style="vertical-align: middle!important;"><?php echo $dokter->aktif == 1 ? 'Aktif' : 'Tidak Aktif' ?></td>
                                               <!--  <td><a href="<?php echo base_url('admin/Pasien/tampilEditPasien/'.$pasien->id);?>"><button class="btn btn-primary btn-primary-one float-right">Edit</button></a></td> -->
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
                </div>