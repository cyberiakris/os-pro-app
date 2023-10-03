<?php
App::uses('AppHelper', 'View/Helper');

class CustomFunctionsHelper extends AppHelper {
    var $helpers = array('Html','Form');

	public function trimText($theText, $lmt)
	{
		$trimmed = FALSE;
		if (strlen($theText) > $lmt) {
			$theText = substr($theText, 0, $lmt);
			//$theText = substr($theText, 0, strrpos($theText,' '));
			$trimmed = TRUE;
		}
		if ($trimmed) $theText .= '...';
		return $theText;

	}

    function trimHtmlText($theText, $lmt)
    {
        // remove tags
        $tagPattern = '~<[^>]*>~';
        $theText = preg_replace($tagPattern, '', $theText);
        // trim text
        $trimmed = FALSE;
        if (strlen($theText) > $lmt) {
            $theText = substr($theText, 0, $lmt);
            $theText = substr($theText, 0, strrpos($theText,' '));
            $trimmed = TRUE;
        }
        if ($trimmed) $theText .= '...';
        return $theText;
    }

	public function timeAgo($datefrom,$dateto=-1)
	{
		// Defaults and assume if 0 is passed in that its an error rather than the epoch
		if($datefrom<=0) { return "A long time ago"; }
		if($dateto==-1) { $dateto = time(); }
		
		// Calculate the difference in seconds betweeen the two timestamps	
		$difference = $dateto - $datefrom;
		
		// If difference is less than 0 seconds, ie future date then return original datetime	
		if($difference < 0)
		{
			$orig = '<span class="label label-success">' . date('d/m/Y', $datefrom) . '</span><br/><span class="label label-success">' . date('h:i a', $datefrom) . '</span>';
			return $orig;
		}	
		// If difference is less than 60 seconds, seconds is a good interval of choice	
		if($difference < 60)
		{
			$interval = "s";
		}	
		// If difference is between 60 seconds and 60 minutes, minutes is a good interval
		elseif($difference >= 60 && $difference<60*60)
		{
			$interval = "n";
		}
		
		// If difference is between 1 hour and 24 hours, hours is a good interval
		elseif($difference >= 60*60 && $difference<60*60*24)
		{
			$interval = "h";
		}
		
		// If difference is between 1 day and 7 days, days is a good interval
		elseif($difference >= 60*60*24 && $difference<60*60*24*7)
		{
			$interval = "d";
		}
		
		// If difference is between 1 week and 30 days, weeks is a good interval
		elseif($difference >= 60*60*24*7 && $difference <
		60*60*24*30)
		{
			$interval = "ww";
		}
		
		/* If difference is between 30 days and 365 days, months is a good interval, again, the same thing applies, if the 29th February happens to exist between your 2 dates, the function will return the 'incorrect' value for a day */
		elseif($difference >= 60*60*24*30 && $difference <
		60*60*24*365)
		{
			$interval = "m";
		}
		
		/* If difference is greater than or equal to 365 days, return year. This will be incorrect if for example, you call the function on the 28th April 2008 passing in 29th April 2007. It will return 1 year ago when in actual fact (yawn!) not quite a year has gone by */
		elseif($difference >= 60*60*24*365)
		{
			$interval = "y";
		}
		
		/* Based on the interval, determine the number of units between the two dates From this point on, you would be hard pushed telling the difference between this function and DateDiff. 
		If the $datediff returned is 1, be sure to return the singular of the unit, e.g. 'day' rather 'days' */	
		switch($interval)
		{
			case "m":
			$months_difference = floor($difference / 60 / 60 / 24 /
			29);
			while (mktime(date("H", $datefrom), date("i", $datefrom),
			date("s", $datefrom), date("n", $datefrom)+($months_difference),
			date("j", $dateto), date("Y", $datefrom)) < $dateto)
			{
				$months_difference++;
			}
			$datediff = $months_difference;
		
			// We need this in here because it is possible
			// to have an 'm' interval and a months
			// difference of 12 because we are using 29 days
			// in a month
			
			if($datediff==12)
			{
			$datediff--;
			}
			
			$res = ($datediff==1) ? "$datediff month ago" : "$datediff
			months ago";
			break;
			
			case "y":
			$datediff = floor($difference / 60 / 60 / 24 / 365);
			$res = ($datediff==1) ? "$datediff year ago" : "$datediff
			years ago";
			break;
			
			case "d":
			$datediff = floor($difference / 60 / 60 / 24);
			$res = ($datediff==1) ? "$datediff day ago" : "$datediff
			days ago";
			break;
			
			case "ww":
			$datediff = floor($difference / 60 / 60 / 24 / 7);
			$res = ($datediff==1) ? "$datediff week ago" : "$datediff
			weeks ago";
			break;
			
			case "h":
			$datediff = floor($difference / 60 / 60);
			$res = ($datediff==1) ? "$datediff hour ago" : "$datediff
			hours ago";
			break;
			
			case "n":
			$datediff = floor($difference / 60);
			$res = ($datediff==1) ? "$datediff minute ago" :
			"$datediff minutes ago";
			break;
			
			case "s":
			$datediff = $difference;
			$res = ($datediff==1) ? "$datediff second ago" :
			"$datediff seconds ago";
			break;
		}
		return $res;
	}

    public function do_item_slug($string){
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $string)));
        return urlencode($slug);
    }

    public function tagcanvas($data, $canvas_id="tag"){
        $display = '';
        $taglist = '';
        $site_url = Router::url('/', true);
        if(count($data)){
            foreach($data as $key => $val){
                $taglist .= '<li><a href="'.$site_url.'tag?q='.$key.'">'.$key.'</a></li>';
            }
        } else {
            $taglist .= '<li><a href="'.$site_url.'">'.DOMAIN.'</a></li>';
        }
        $display .= '<div id="'.$canvas_id.'CanvasContainer">
         <canvas width="600" height="400" id="'.$canvas_id.'Canvas">
          <p>In Internet Explorer versions up to 8, things inside the canvas are inaccessible!</p>
         </canvas>
        </div>
        <div id="'.$canvas_id.'tags">
         <ul>
          '.$taglist.'
         </ul>
        </div>';
        return $display;
    }

    public function formatBytes($bytes, $precision = 2) {
        $units = array('B', 'KB', 'MB', 'GB', 'TB');

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        // Uncomment one of the following alternatives
         $bytes /= pow(1024, $pow);
        // $bytes /= (1 << (10 * $pow));

        return round($bytes, $precision) . ' ' . $units[$pow];
    }

    public function getFileExtension($str) {

        $i = strrpos($str,".");
        if (!$i) { return ""; }

        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);

        return $ext;
    }

    public function niceNumber($n, $abbr=true) {
        // first strip any formatting;
        $n = (0+str_replace(",", "", $n));

        $t = ($abbr) ? 'trillion' : 'T' ;
        $b = ($abbr) ? 'billion' : 'B' ;
        $m = ($abbr) ? 'million' : 'M' ;
        $k = ($abbr) ? 'thousand' : 'K' ;

        // is this a number?
        if (!is_numeric($n)) return false;

        // now filter it;
        if ($n > 1000000000000) return round(($n/1000000000000), 2).' '.$t;
        elseif ($n > 1000000000) return round(($n/1000000000), 2).' '.$b;
        elseif ($n > 1000000) return round(($n/1000000), 2).' '.$m;
        elseif ($n > 1000) return round(($n/1000), 2).' '.$k;

        return number_format($n, 1);
    }

    public function truncate_html($html, $length = 100, $ending = '...')
    {
        if (!is_string($html)) {
            trigger_error('Function \'truncate_html\' expects argument 1 to be an string', E_USER_ERROR);
            return false;
        }

        if (mb_strlen(strip_tags($html)) <= $length) {
            return $html;
        }
        $total = mb_strlen($ending);
        $open_tags = array();
        $return = '';
        $finished = false;
        $final_segment = '';
        $self_closing_elements = array(
            'area',
            'base',
            'br',
            'col',
            'frame',
            'hr',
            'img',
            'input',
            'link',
            'meta',
            'param'
        );
        $inline_containers = array(
            'a',
            'b',
            'abbr',
            'cite',
            'em',
            'i',
            'kbd',
            'span',
            'strong',
            'sub',
            'sup'
        );
        while (!$finished) {
            if (preg_match('/^<(\w+)[^>]*>/', $html, $matches)) { // Does the remaining string start in an opening tag?
                // If not self-closing, place tag in $open_tags array:
                if (!in_array($matches[1], $self_closing_elements)) {
                    $open_tags[] = $matches[1];
                }
                // Remove tag from $html:
                $html = substr_replace($html, '', 0, strlen($matches[0]));
                // Add tag to $return:
                $return .= $matches[0];
            } elseif (preg_match('/^<\/(\w+)>/', $html, $matches)) { // Does the remaining string start in an end tag?
                // Remove matching opening tag from $open_tags array:
                $key = array_search($matches[1], $open_tags);
                if ($key !== false) {
                    unset($open_tags[$key]);
                }
                // Remove tag from $html:
                $html = substr_replace($html, '', 0, strlen($matches[0]));
                // Add tag to $return:
                $return .= $matches[0];
            } else {
                // Extract text up to next tag as $segment:
                if (preg_match('/^([^<]+)(<\/?(\w+)[^>]*>)?/', $html, $matches)) {
                    $segment = $matches[1];
                    // Following code taken from https://trac.cakephp.org/browser/tags/1.2.1.8004/cake/libs/view/helpers/text.php?rev=8005.
                    // Not 100% sure about it, but assume it deals with utf and html entities/multi-byte characters to get accureate string length.
                    $segment_length = mb_strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', ' ', $segment));
                    // Compare $segment_length + $total to $length:
                    if ($segment_length + $total > $length) { // Truncate $segment and set as $final_segment:
                        $remainder = $length - $total;
                        $entities_length = 0;
                        if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|&#x[0-9a-f]{1,6};/i', $segment, $entities, PREG_OFFSET_CAPTURE)) {
                            foreach($entities[0] as $entity) {
                                if ($entity[1] + 1 - $entities_length <= $remainder) {
                                    $remainder--;
                                    $entities_length += mb_strlen($entity[0]);
                                } else {
                                    break;
                                }
                            }
                        }
                        // Otherwise truncate $segment and set as $final_segment:
                        $finished = true;
                        $final_segment = mb_substr($segment, 0, $remainder + $entities_length);
                    } else {
                        // Add $segment to $return and increase $total:
                        $return .= $segment;
                        $total += $segment_length;
                        // Remove $segment from $html:
                        $html = substr_replace($html, '', 0, strlen($segment));
                    }
                } else {
                    $finshed = true;
                }
            }
        }
        // Check for spaces in $final_segment:
        if (strpos($final_segment, ' ') === false && preg_match('/<(\w+)[^>]*>$/', $return)) { // If none and $return ends in an opening tag: (we ignore $final_segment)
            // Remove opening tag from end of $return:
            $return = preg_replace('/<(\w+)[^>]*>$/', '', $return);
            // Remove opening tag from $open_tags:
            $key = array_search($matches[3], $open_tags);
            if ($key !== false) {
                unset($open_tags[$key]);
            }
        } else { // Otherwise, truncate $final_segment to last space and add to $return:
            // $spacepos = strrpos($final_segment, ' ');
            $return .= mb_substr($final_segment, 0, mb_strrpos($final_segment, ' '));
        }
        $return = trim($return);
        $len = strlen($return);
        $last_char = substr($return, $len - 1, 1);
        if (!preg_match('/[a-zA-Z0-9]/', $last_char)) {
            $return = substr_replace($return, '', $len - 1, 1);
        }
        // Add closing tags:
        $closing_tags = array_reverse($open_tags);
        $ending_added = false;
        foreach($closing_tags as $tag) {
            if (!in_array($tag, $inline_containers) && !$ending_added) {
                $return .= $ending;
                $ending_added = true;
            }
            $return .= '</' . $tag . '>';
        }
        return $return;
    }
}