<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Minifyhtml Class
 * Will Minify the HTML. Reducing network latency, enhancing compression, and faster browser loading and execution.
 * 
 * @category    Output
 * @author      John Gerome
 * @link        https://github.com/johngerome/CodeIgniter-Minifyhtml-hooks
 */

class Minifyhtml {

    /**
     * Responsible for sending final output to browser
     */

    function output()
    {
        $CI =& get_instance();
        $buffer = $CI->output->get_output();
        // echo $buffer;
        foreach($CI->config->config as $index => $value){
            if(is_string($index) AND is_string($value))
             $buffer = str_replace('{_'.$index.'_}', $value, $buffer);
        }
        
        if(false):
            $re = '%            # Collapse ws everywhere but in blacklisted elements.
                (?>             # Match all whitespans other than single space.
                  [^\S ]\s*     # Either one [\t\r\n\f\v] and zero or more ws,
                | \s{2,}        # or two or more consecutive-any-whitespace.
                ) # Note: The remaining regex consumes no text at all...
                (?=             # Ensure we are not in a blacklist tag.
                  (?:           # Begin (unnecessary) group.
                    (?:         # Zero or more of...
                      [^<]++    # Either one or more non-"<"
                    | <         # or a < starting a non-blacklist tag.
                      (?!/?(?:textarea|pre)\b)
                    )*+         # (This could be "unroll-the-loop"ified.)
                  )             # End (unnecessary) group.
                  (?:           # Begin alternation group.
                    <           # Either a blacklist start tag.
                    (?>textarea|pre)\b
                  | \z          # or end of file.
                  )             # End alternation group.
                )  # If we made it here, we are not in a blacklist tag.
                %ix';
            $buffer = preg_replace($re, " ", $buffer);
        endif;
        
        if(!$CI->input->post() AND strtolower($CI->uri->segment(1,0)) != 'admin' AND defined('CLIENT_ID') ){
            
            if(is_html($buffer)):
                $htmlDom = new DOMDocument();
                @$htmlDom->loadHTML($buffer, LIBXML_HTML_NODEFDTD | LIBXML_HTML_NOIMPLIED);
       
                $allWidgets = $htmlDom->getElementsByTagName('thewidget');
               
                foreach ($allWidgets as $widget) {
                    if($id = $widget->getAttribute('id') AND $widget->nodeValue != ''){
                        if($id == 'visitor_counter'){
                           $nodeDiv = $htmlDom->createElement("div", '{_all_visits_}');
                           $widget->parentNode->replaceChild($nodeDiv, $widget);
                        }
                        else{
                           $divInner = $htmlDom->createDocumentFragment();
                            @$divInner->appendXML((getWidget($id)));
                           $widget->parentNode->replaceChild($divInner, $widget);
                        }
                    }
                }
                
                $buffer = (string)$htmlDom->saveHTML();
            endif;
        }
        
        
        foreach($CI->config->config as $index => $value){
            if(is_string($index) AND is_string($value))
            $buffer = str_replace('{_'.$index.'_}', $value, $buffer);
        }
        
        $buffer = preg_replace('/'.preg_quote('{_').'[\s\S]+?'.preg_quote('_}').'/', '', $buffer);
        
                //  $buffer = preg_replace("/<p[^>]*><\\/p[^>]*>/", '', $buffer);
        $buffer = preg_replace("/<p[^>]*>(?:\s|&nbsp;)*<\/p>/", '', $buffer);        
        $CI->output->set_output($buffer);
        $CI->output->_display();
    }
    
    
    function getTextBetweenTags($string, $tagname) {
        $pattern = "/<$tagname>(.*?)<\/$tagname>/";
        preg_match($pattern, $string, $matches);
        return @$matches[1];
    }
}
?>