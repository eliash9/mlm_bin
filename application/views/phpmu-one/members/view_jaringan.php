<?php
echo "<p class='sidebar-title'><span class='glyphicon glyphicon-volume-up'></span> Jaringan Anda <a class='btn btn-xs btn-success pull-right' href='' onclick=\"window.history.back();\">Kembali</a></p>";
$idmember = $this->session->username;
if($this->uri->segment(3) != ''){ $useridd = $this->uri->segment(3); }else{ $useridd = $this->session->username; }
if($this->uri->segment(3) != ''){
  $row = $this->model_members->jaringan($useridd)->row_array();
}else{
  $row = $this->model_members->jaringan($idmember)->row_array();
}

    $d1 = $row['foot1']; 
    $d2 = $row['foot2'];
  //  $d3 = $row['foot3'];
    if (trim($row['foto'])==''){ $photo_member1 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>"; }else{ $photo_member1 = "<img class='image0' src='".base_url()."asset/foto_user/".$row['foto']."'>"; }
    if($idmember==$useridd){
      $member_id = "<a class='link' href='#'>$photo_member1</a><br>
                    <a style='width:101px; border-radius:0px' class='btn btn-xs btn-success' href=''>$idmember</a>";
    }elseif($row['upline']!=''){
      $member_id = "<a class='link' href='".base_url()."members/jaringan/$row[upline]'>$photo_member1</a><br>
                    <a style='width:101px; border-radius:0px' class='btn btn-xs btn-success' href='#'>$useridd</a>";
    }else{
      $member_id = "<a class='link' href='#'>$photo_member1</a><br>
                    <a style='width:101px; border-radius:0px' class='btn btn-xs btn-success' href=''>$idmember</a>";
    }

    $row=$this->model_members->jaringan($d1)->row_array();
    if (trim($row['foto'])==''){ $photo_d1 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>"; }else{ $photo_d1 = "<img class='image0' src='".base_url()."asset/foto_user/".$row['foto']."'>"; }
      if($d1!=''){
        $down1 = "<a class='link' href='".base_url()."members/jaringan/$d1'>1<br>$photo_d1</a><br>
                  <a style='width:101px; border-radius:0px' class='btn btn-xs btn-success' href='#'>$d1</a>";
      }else{
        $down1 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$useridd/0'>1<br><img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:101px; border-radius:0px' class='btn btn-xs btn-danger' href='".base_url()."members/tambah_jaringan/$useridd/0'>?</a>";
      }

    $row=$this->model_members->jaringan($d2)->row_array();
    if (trim($row['foto'])==''){ $photo_d2 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>"; }else{ $photo_d2 = "<img class='image0' src='".base_url()."asset/foto_user/".$row['foto']."'>"; }
      if($d2!=''){
        $down2 = "<a class='link' href='".base_url()."members/jaringan/$d2'>2<br>$photo_d2</a><br>
                  <a style='width:101px; border-radius:0px' class='btn btn-xs btn-success' href='#'>$d2</a>";
      }else{
        $down2 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$useridd/1'>2<br><img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:101px; border-radius:0px' class='btn btn-xs btn-danger' href='".base_url()."members/tambah_jaringan/$useridd/1'>?</a>";
      }


    $row=$this->model_members->totalkonsumen($d1)->row_array();
    $d3 = $row['foot1']; 
    $d4 = $row['foot2'];
  //  $d6 = $row['foot3'];
    $row=$this->model_members->jaringan($d3)->row_array();
    if (trim($row['foto'])==''){ $photo_d3 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>"; }else{ $photo_d3 = "<img class='image0' src='".base_url()."asset/foto_user/".$row['foto']."'>"; }
      if($d3!=''){
        $down3 = "<a class='link' href='".base_url()."members/jaringan/$d3'>3<br>$photo_d3</a><br>
                  <a style='width:101px; border-radius:0px' class='btn btn-xs btn-success' href='#'>$d3</a>";
      }else{
        if(!empty($d1)){
          $down3 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$d1/0'>3<br><img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:101px; border-radius:0px' class='btn btn-xs btn-danger' href='".base_url()."members/tambah_jaringan/$d1/0'>?</a>";
        }else{
          $down3 = "<a class='link0' href='#'>3<br><img class='image0' src='".base_url()."asset/foto_user/users1.png'></a><br>
                   <a style='width:101px; border-radius:0px' class='btn btn-xs btn-danger' href='".base_url()."members/tambah_jaringan'>-</a>";
        }
      }

    $row=$this->model_members->jaringan($d4)->row_array();
    if (trim($row['foto'])==''){ $photo_d4 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>"; }else{ $photo_d4 = "<img class='image0' src='".base_url()."asset/foto_user/".$row['foto']."'>"; }
    if($d4!=''){
       $down4 = "<a class='link' href='".base_url()."members/jaringan/$d4'>4<br>$photo_d4</a><br>
                 <a style='width:101px; border-radius:0px' class='btn btn-xs btn-success' href='#'>$d4</a>";
    }else{
       if(!empty($d2)){
          $down4 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$d1/1'>4<br><img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:101px; border-radius:0px' class='btn btn-xs btn-danger' href='".base_url()."members/tambah_jaringan/$d1/1'>?</a>";
        }else{
          $down4 = "<a class='link0' href='#'>4<br><img class='image0' src='".base_url()."asset/foto_user/users1.png'></a><br>
                   <a style='width:101px; border-radius:0px' class='btn btn-xs btn-danger' href='".base_url()."members/tambah_jaringan'>-</a>";
        }
    }

    


    $row=$this->model_members->totalkonsumen($d2)->row_array();
    $d5=$row['foot1']; 
    $d6=$row['foot2'];
   // $d9=$row['foot3'];
    $row=$this->model_members->jaringan($d5)->row_array();
    if (trim($row['foto'])==''){ $photo_d5 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>"; }else{ $photo_d5 = "<img class='image0' src='".base_url()."asset/foto_user/".$row['foto']."'>"; }
      if($d5!=''){
         $down5 = "<a class='link' href='".base_url()."members/jaringan/$d5'>5<br>$photo_d5</a><br>
                   <a style='width:101px; border-radius:0px' class='btn btn-xs btn-success' href='#'>$d5</a>";
      }else{
        if(!empty($d2)){
          $down5 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$d2/0'>5<br><img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:101px; border-radius:0px' class='btn btn-xs btn-danger' href='".base_url()."members/tambah_jaringan/$d2/0'>?</a>";
        }else{
          $down5 = "<a class='link0' href='#'>5<br><img class='image0' src='".base_url()."asset/foto_user/users1.png'></a><br>
                   <a style='width:101px; border-radius:0px' class='btn btn-xs btn-danger' href='".base_url()."members/tambah_jaringan'>-</a>";
        }
      }

    $row=$this->model_members->jaringan($d6)->row_array();
    if (trim($row['foto'])==''){ $photo_d6 = "<img class='image0' src='".base_url()."asset/foto_user/users.gif'>"; }else{ $photo_d6 = "<img class='image0' src='".base_url()."asset/foto_user/".$row['foto']."'>"; }
      if($d6!=''){
          $down6 = "<a class='link' href='".base_url()."members/jaringan/$d6'>6<br>$photo_d6</a><br>
                   <a style='width:101px; border-radius:0px' class='btn btn-xs btn-success' href='#'>$d6</a>";
       }else{
         if(!empty($d2)){
          $down6 = "<a class='link0' href='".base_url()."members/tambah_jaringan/$d2/1'>6<br><img class='image0' src='".base_url()."asset/foto_user/users.png'></a><br>
                   <a style='width:101px; border-radius:0px' class='btn btn-xs btn-danger' href='".base_url()."members/tambah_jaringan/$d2/1'>?</a>";
        }else{
          $down6 = "<a class='link0' href='#'>6<br><img class='image0' src='".base_url()."asset/foto_user/users1.png'></a><br>
                   <a style='width:101px; border-radius:0px' class='btn btn-xs btn-danger' href='".base_url()."members/tambah_jaringan'>-</a>";
        }
       }

    

    

    echo "<div style='overflow-x:scroll; width:100%' align='center'>
            <div style='width:500px' class='tree'>
              <ul>
                <li>$member_id
                    <ul>
                      <li>$down1
                        <ul>
                          <li>$down3</li>
                          <li>$down4</li>                         
                        </ul>
                      </li>
                      <li>$down2
                        <ul>
                          <li>$down5</li>
                          <li>$down6</li>                         
                        </ul>
                      </li>     
                    </ul>
                </li>
              </ul>
            </div>
          </div>
  <div style='clear:both'></div><br>";

                      
