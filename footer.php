
        <!-- footer content -->
        <footer>
            <div class="pull-right">
                Hệ thống quản lý bán hàng
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>
</div>

<!-- jQuery -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="js/jquery.min.js"></script>

<!-- Bootstrap -->
<script src="js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="js/fastclick.js"></script>
<!-- NProgress -->
<script src="js/nprogress.js"></script>

<!-- Custom Theme Scripts -->
<script src="js/custom.min.js"></script>
<script src="js/morris.min.js"></script>


<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script>
const newArr = <?php
   foreach($result as $key=>$value){
       $arr[] = (object)array(
        $value["invesment"],
        $value["collected"],
        $value["collected"]-$value["invesment"],
        $value["create_date"],
       );
   }
   echo $arr2 = json_encode($arr);
  ?>;
console.log(newArr)
new Morris.Bar({
  element: 'myfirstchart',
  data: newArr,
  xkey: '3',
  ykeys: ['0','1','2'],
  labels: ['Vốn', 'Thu được', 'Lợi nhuận', 'Ngày']
});

                            </script>
</body>
</html>
