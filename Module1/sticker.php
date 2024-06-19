<style>
    .background{
        background-color: #ff4019;
        width: 25vw;
        height: 50vh;
        text-align: center;
        font-family: 'Poppins';
    }

    img{
        width: 10vw;
        height: 15vh;
    }

    h2{
        color: aliceblue;
    }

    @media print{
        .background, .background * {
            display : block;
        }
    }
</style>
<div class="background container">
<?php 
$v_id = isset($_GET['v_id']) ? htmlspecialchars($_GET['v_id']) : '';
?>
    <img src="../Asset/Img/Logo UMPSA-full color.png" alt="Logo UMPSA">
    <h2>PAS MASUK KENDERAAN</h2>
    <h2>2024/2025</h2>
    <h5><?php echo $v_id; ?></h5>
</div>
<button id="printbtn">Print</button>

<script>
    const printBtn = getElementById('printbtn');
    printBtn.addEventListener('click', function(){
        print();
    })
</script>