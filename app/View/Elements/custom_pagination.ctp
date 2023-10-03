<?php if(isset($page) && count($page)){ 
$the_page = ($this->params['here']) ? $this->params['here'] : '' ;
$page_query = '';
/*
if(!empty($_SERVER['QUERY_STRING']) && !isset($_REQUEST['page'])){
	$page_query .= 'q='.$_REQUEST['q'].'&c='.$_REQUEST['c'].'&';
}
*/
echo '<nav>
    <ul class="pagination">';

		echo ($page['prevPage']) ? '<li><a href="'.$the_page.'?'.$page_query.'page='.($page['page']-1).'">Prev</a></li>' : '<li><a href="javascript:void(0);">Prev</a></li>' ; 
		// before
        if( $page['page'] > 1 ) {
			if(($page['page'] - 2) > 1){
				echo '<li><a href="'.$the_page.'?'.$page_query.'page=1">First</a></li>';
				echo '<li><a href="javascript:void(0);">...</a></li>';
			}
			$prev = array();
			$breaker = 0;
			$prev_page = $page['page'] - 1;
			for($k = $prev_page; $k > 0; $k--){
				if($breaker==2){
					break;
				}
				$prev[] = '<li><a href="'.$the_page.'?'.$page_query.'page='.$k.'">'.$k.'</a></li>';
				$breaker++;
			}
			if(count($prev)){
				$order_prev = array_reverse($prev);
				foreach($order_prev as $op){
					echo $op;
				}
			}
		}
		// here 
		echo '<li class="active"><a href="javascript:void(0)">'.$page['page'].'</a></li>';
		//and after
        if( $page['page'] <= $page['pageCount'] ) {
			$breaker = 0;
			$next_page = $page['page'] + 1;
			for($p = $next_page; $p <= $page['pageCount']; $p++){
				if($breaker==2){
					echo '<li><a href="javascript:void(0);">...</a></li>';
					echo '<li><a href="'.$the_page.'?'.$page_query.'page='.$page['pageCount'].'">Last</a></li>';
					break;
				}
				echo '<li><a href="'.$the_page.'?'.$page_query.'page='.$p.'">'.$p.'</a></li>';
				$breaker++;
			}
		}
        echo ($page['nextPage']) ? '<li><a href="'.$the_page.'?'.$page_query.'page='.($page['page']+1).'">Next</a></li>' : '<li><a href="javascript:void(0);">Next</a></li>' ; 

echo '    </ul>
</nav>';
} ?>
