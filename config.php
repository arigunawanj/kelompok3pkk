<?php
$db = mysqli_connect("localhost", "root", "", "library");

$bookcode = "";
$title = "";
$publiser = "";
$cover = "";
$author = "";


$class = "";
$name = "";
$nis = "";

$id_book = "";
$sukses = "";
$sukses2 = "";
//read Book
$perMinggu = 60 * 60 * 24 * 7;
$date = getdate();
$loan_date = date('m/d/Y');
$retrun_date = date('m/d/Y ', time() + $perMinggu * 1);

//rondom id peminjaman
$randomNumber = rand(1, 1000);

if ($sukses) {
            
  header("refresh:2;url=home.php?page=data-peminjaman");
}
if ($sukses2) {
            
    header("refresh:2;url=home.php?page=data-pengembalian");
  }
  
function read($table)
{
    global $db;
    $query = "SELECT * FROM " . $table;
    $rows = mysqli_query($db, $query);
    if (isset($_GET['cari'])) {
        $rows = mysqli_query($db, "SELECT * from book WHERE title LIKE '%" . $_GET['cari'] . "%' OR author LIKE '%" . $_GET['cari'] . "%'");
    }
    return $rows;
}

function loan($data)
{
    global $db;
    global $bookcode;
    global $title;
    global $publiser;
    global $cover;
    global $author;
    global $stock;

    $id         = $data['id'];
    $query      = "SELECT * from book where id_book = '$id'";
    $rows       = mysqli_query($db, $query);
    $r1         = mysqli_fetch_array($rows);

    $bookcode        = $r1['id_book'];
    $title           = $r1['title'];
    $publiser        = $r1['publiser'];
    $cover           = $r1['cover'];
    $author          = $r1['author'];
    $stock           = $r1['stock'];

    return $r1;
}

// function nis($nis, $save)
// {
//     global $db;
//     global $name;
//     global $class;


//     if ($nis != null) {

//         $rows = mysqli_query($db, "SELECT student.nis, student.nama, class.nama_kelas
//         FROM student, class
//         WHERE student.nis LIKE '$nis'");
//         $r1 = mysqli_fetch_array($rows);
//         $name  = $r1['nama'];
//         $class = $r1['nama_kelas'];

// }
// }

function tmp($data)
{

    global $db;
    //global $sukses;

    global $cover;
    global $author;
    global $title;
    global $publiser;
    global $stock;
    global $sukses;

    $id    = $data['id'];
    $query = "INSERT INTO temporari (id_book, cover, author, title, publiser ) VALUES ('$id','$cover', '$author', '$title','$publiser')";
    $rows = mysqli_query($db, $query);
    //$sukses = "Data save succesfully";


    $stock--;
    $query1 = "UPDATE book SET stock = $stock WHERE id_book = $id";
    $rows = mysqli_query($db, $query1);

    $sukses = "Save data Sucessfuly";
    return $rows;
}

function read_tmp($table)
{
    global $db;
    $query = "SELECT * FROM " . $table;
    $rows = mysqli_query($db, $query);
    return $rows;
}

function delete_tmp($data)
{
    global $db;
    global $stock;
    global $id_book;
    global $sukses;
    //global $sukses;

    $id         = $data['id'];

    $querytmp  = "SELECT * FROM temporari WHERE id_tmp = $id";
    $q         = mysqli_query($db, $querytmp);
    $q1        = mysqli_fetch_array($q);
    $id_book   = $q1['id_book'];


    $sql1       = "DELETE from temporari where id_tmp = '$id'";
    $q1         = mysqli_query($db, $sql1);

    $query     = "SELECT book.id_book, book.stock FROM book WHERE id_book = $id_book";
    $q2        = mysqli_query($db, $query);
    $q1        = mysqli_fetch_array($q2);
    $book      = $q1['id_book'];
    $stock     = $q1['stock'];


    $hasil = $stock + 1;
    $query1 = "UPDATE book SET stock = $hasil WHERE id_book = $id_book";
    $q1 = mysqli_query($db, $query1);

    $sukses = "Save data Sucessfuly";
    return $q1;
}




function insert_loan($data)
{
    global $db;
    global $loan_date;
    global $retrun_date;
    global $randomNumber;
    global $sukses;
    $nis = $data['nis'];
    $id_book = $data['book'];
    $tgl_P = $data['loan_date'];
    $tgl_K = $data['retrun_date'];


    //insert tabel peminjaman
    if ($nis != null && $id_book != null) {

        $query  = "INSERT INTO loan (id_loan, id_student, id_officer, date_loan, date_retrun) VALUES ('$randomNumber','$nis','55','$tgl_P','$tgl_K')";
        $sql    = mysqli_query($db, $query);
        $jml = count($id_book);
        for ($i = 0; $i < $jml; $i++) {
            # code...
            $query2 = "INSERT INTO loan_detail (id_book, id_loan) VALUE ('$id_book[$i]','$randomNumber')";
            $sql    = mysqli_query($db, $query2);
        }

        // delete temporarri
        $query3 = "DELETE FROM temporari";
        $sql    = mysqli_query($db, $query3);
        $sukses = "Save data Sucessfuly";
        header('Location: home.php?page=data-pengembalian');
        return $sql;
    } else {
        echo '<script type="text/javascript">alert("insert all data")</script>';
        header("refresh:1;url=home.php?page=data-peminjaman");
    }
}

function read_detailloan()
{
    global $db;

    $query = "SELECT loan_detail.id_detail_loan, loan.id_loan, book.cover, book.title, student.nis ,student.nama, loan.date_loan, loan.date_retrun 
    FROM loan_detail, book, student, loan WHERE loan_detail.id_book = book.id_book 
    AND loan_detail.id_loan = loan.id_loan AND loan.id_student = student.nis";
    $sql = mysqli_query($db, $query);
    return $sql;
}

function insert_retrun($data)
{
    global $db;
    global $stock;
    global $sukses2;

    $id = $data['id'];
    $id_dtl = $data['id2'];
    $loan_date = date("Y-m-d");
    $denda = "";

    $query = "SELECT loan.id_loan, loan.date_retrun
    FROM loan WHERE loan.id_loan = $id";
    $sq = mysqli_query($db, $query);
    $sql = mysqli_fetch_array($sq);

    if ($loan_date > $sql['date_retrun']) {

        $t = date_create($sql['date_retrun']);
        $n = date_create(date('Y-m-d'));
        $terlambat = date_diff($t, $n);
        $hari = $terlambat->format("%a");
        $denda = $hari * 1000;
    } else {
        $denda = 0;
    }


    // insert data retrun
    $query = "INSERT INTO retrun (id_loan, date_loan, fine) VALUES ('$id','$loan_date','$denda')";
    $sql = mysqli_query($db, $query);
    // delete id_peminjaman
    
    // add stock book
    $query3     = "SELECT loan_detail.id_book, loan_detail.id_loan FROM loan_detail WHERE id_loan = $id";
    $q2        = mysqli_query($db, $query3);
    $sql        = mysqli_fetch_array($q2);
    $id_book   = $sql['id_book'];
    
    
    $query4     = "SELECT * FROM `book` WHERE book.id_book = $id_book";
    $q3         = mysqli_query($db, $query4);
    $sql        = mysqli_fetch_array($q3);
    $stock      = $sql['stock'];

    $hasil = $stock + 1;
    $query1 = "UPDATE book SET stock = $hasil WHERE id_book = $id_book";
    $sql = mysqli_query($db, $query1);
    
    $query2  = " DELETE from loan_detail where id_detail_loan = '$id_dtl'";
    $sql         = mysqli_query($db, $query2);

    $sukses2 = "Save data Sucessfuly";
    return $sql;
}


function history(){
global $db;

$query = "SELECT student.nis, student.nama, retrun.date_loan ,retrun.fine 
FROM  student, loan, retrun 
WHERE loan.id_student = student.nis AND retrun.id_loan = loan.id_loan";

$sql = mysqli_query($db, $query);
return $sql;
}