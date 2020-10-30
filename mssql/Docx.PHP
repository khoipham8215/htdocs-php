<?php 
class DocxConversion{ 
    private $filename; 
 
    public function __construct($filePath) { 
        $this->filename = $filePath; 
    } 
 
    private function read_doc() { 
        $fileHandle = fopen($this->filename, "r"); 
        $line = @fread($fileHandle, filesize($this->filename));    
        $lines = explode(chr(0x0D),$line); 
        $outtext = ""; 
        foreach($lines as $thisline) 
          { 
            $pos = strpos($thisline, chr(0x00)); 
            if (($pos !== FALSE)||(strlen($thisline)==0)) 
              { 
              } else { 
                $outtext .= $thisline." "; 
              } 
          } 
         $outtext = preg_replace("/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/","",$outtext); 
        return $outtext; 
    } 
 
    private function read_docx(){ 
 
        $striped_content = ''; 
        $content = ''; 
 
        $zip = zip_open($this->filename); 
 
        if (!$zip || is_numeric($zip)) return false; 
 
        while ($zip_entry = zip_read($zip)) { 
 
            if (zip_entry_open($zip, $zip_entry) == FALSE) continue; 
 
            if (zip_entry_name($zip_entry) != "word/document.xml") continue; 
 
            $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
            //$content.='<br/>';
             zip_entry_close($zip_entry); 
        }// end while 
 
        zip_close($zip); 
 
        $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content); 
        $content = str_replace('</w:r></w:p>', "\r\n", $content); 
        $striped_content = strip_tags($content); 
        $striped_content=$content;
        return $striped_content; 
    } 
 
 /************************excel sheet************************************/ 
 
function xlsx_to_text($input_file){ 
    $xml_filename = "xl/sharedStrings.xml"; //content file name 
    $zip_handle = new ZipArchive; 
    $output_text = ""; 
    if(true === $zip_handle->open($input_file)){ 
        if(($xml_index = $zip_handle->locateName($xml_filename)) !== false){ 
            $xml_datas = $zip_handle->getFromIndex($xml_index); 
            $xml_handle = DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING); 
            $output_text = strip_tags($xml_handle->saveXML()); 
        }else{ 
            $output_text .=""; 
        } 
        $zip_handle->close(); 
    }else{ 
    $output_text .=""; 
    } 
    return $output_text; 
} 
 
/*************************power point files*****************************/ 
function pptx_to_text($input_file){ 
    $zip_handle = new ZipArchive; 
    $output_text = ""; 
    if(true === $zip_handle->open($input_file)){ 
        $slide_number = 1; //loop through slide files 
        while(($xml_index = $zip_handle->locateName("ppt/slides/slide".$slide_number.".xml")) !== false){ 
            $xml_datas = $zip_handle->getFromIndex($xml_index); 
            $xml_handle = DOMDocument::loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING); 
            $output_text .= strip_tags($xml_handle->saveXML()); 
            $slide_number++; 
        } 
        if($slide_number == 1){ 
            $output_text .=""; 
        } 
        $zip_handle->close(); 
    }else{ 
    $output_text .=""; 
    } 
    return $output_text; 
} 
 
 
    public function convertToText() { 
 
        if(isset($this->filename) && !file_exists($this->filename)) { 
            return "File Not exists"; 
        } 
 
        $fileArray = pathinfo($this->filename); 
        $file_ext  = $fileArray['extension']; 
        if($file_ext == "doc" || $file_ext == "docx" || $file_ext == "xlsx" || $file_ext == "pptx") 
        { 
            if($file_ext == "doc") { 
                return $this->read_doc(); 
            } elseif($file_ext == "docx") { 
                return $this->read_docx(); 
            } elseif($file_ext == "xlsx") { 
                return $this->xlsx_to_text(); 
            }elseif($file_ext == "pptx") { 
                return $this->pptx_to_text(); 
            } 
        } else { 
            return "Invalid File Type"; 
        } 
    }
 /*

==========================================================================
=========================================================================
And below is get_url() function: Better than fie_get_contents();
*/

public function get_url( $url,$timeout = 5 )
    {
        $url = str_replace( "&amp;", "&", urldecode(trim($url)) );
        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
        curl_setopt( $ch, CURLOPT_URL, $url );
        curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
        curl_setopt( $ch, CURLOPT_ENCODING, "" );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
        curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
        curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
        curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
        curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
        $content = curl_exec( $ch );
        //$response = curl_getinfo( $ch ); 
        curl_close ( $ch );
        return $content;
    } 
 public function extractDocxText($url,$file_name){
        $docx = get_url($url);
        file_put_contents("tempf.docx",$docx);
        $xml_filename = "word/document.xml"; //content file name
        $zip_handle = new ZipArchive;
        $output_text = "";
        if(true === $zip_handle->open("tempf.docx")){
            if(($xml_index = $zip_handle->locateName($xml_filename)) !== false){
                $xml_datas = $zip_handle->getFromIndex($xml_index);
                //file_put_contents($input_file.".xml",$xml_datas);
                $replace_newlines = preg_replace('/<w:p w[0-9-Za-z]+:[a-zA-Z0-9]+="[a-zA-z"0-9 :="]+">/',"\n\r",$xml_datas);
                $replace_tableRows = preg_replace('/<w:tr>/',"\n\r",$replace_newlines);
                $replace_tab = preg_replace('/<w:tab\/>/',"\t",$replace_tableRows);
                $replace_paragraphs = preg_replace('/<\/w:p>/',"\n\r",$replace_tab);
                $replace_other_Tags = strip_tags($replace_paragraphs);          
                $output_text = $replace_other_Tags;
            }else{
                $output_text .="";
            }
            $zip_handle->close();
        }else{
        $output_text .=" ";
        }
        chmod("tempf.docx", 0777);  unlink(realpath("tempf.docx"));
        //save to file or echo content
        file_put_contents($file_name,$output_text);
        echo $output_text;
    }

//========PDF===========
//Requires installation in your Linux server
//sudo su
//apt-get install xpdf
public function extractPdfText($url,$PDF_fullpath_or_Filename){
    $pdf = get_url($url);
    file_put_contents ("temppdf.txt", $pdf);
    $content = pdf2text("temppdf.txt");
    chmod("temppdf.txt", 0777); unlink(realpath("temppdf.txt"));
    echo $content;
    file_put_contents($PDF_fullpath_or_Filename,$content);
    }



//========DOC==========
public function extractDocText($url,$file_name){
    $doc = get_url($url);
    file_put_contents ("tempf.txt", $doc);

    $fileHandle = fopen("tempf.txt", "r");
    $line = @fread($fileHandle, filesize("tempf.txt"));
    $lines = explode(chr(0x0D),$line);
    $outtext = "";
    foreach($lines as $thisline){
        $pos = strpos($thisline, chr(0x00));
        if (($pos !== FALSE)||(strlen($thisline)==0))
        {} else {$outtext .= $thisline."\n\r";}
        }
    $content = preg_replace('/[a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/','  ',$outtext);

    //chmod("tempf.txt", 0777); unlink(realpath("tempf.txt"));
    echo $content;
    file_put_contents($file_name,$content);
    }


//========XLSX==========
public function extractXlsxText($url,$file_name){
    $xlsx = get_url($url);
    file_put_contents ("tempf.txt", $xlsx);
    $content = "";
    $dir = 'tempforxlsx';
    // Unzip
    $zip = new ZipArchive();
    $zip->open("tempf.txt");
    $zip->extractTo($dir);
    // Open up shared strings & the first worksheet
    $strings = simplexml_load_file($dir . '/xl/sharedStrings.xml');
    $sheet   = simplexml_load_file($dir . '/xl/worksheets/sheet1.xml');
    // Parse the rows
    $xlrows = $sheet->sheetData->row;
    foreach ($xlrows as $xlrow) {
        $arr = array();

        // In each row, grab it's value
        foreach ($xlrow->c as $cell) {
            $v = (string) $cell->v;

            // If it has a "t" (type?) of "s" (string?), use the value to look up string value
            if (isset($cell['t']) && $cell['t'] == 's') {
                $s  = array();
                $si = $strings->si[(int) $v];

                // Register & alias the default namespace or you'll get empty results in the xpath query
                $si->registerXPathNamespace('n', 'http://schemas.openxmlformats.org/spreadsheetml/2006/main');
                // Cat together all of the 't' (text?) node values
                foreach($si->xpath('.//n:t') as $t) {
                    $content .= $t."  ";}   }
            }
        }
    echo $content;
    file_put_contents($file_name,$content);
    }


//========PPT========== 
public function extractPptText($url,$file_name){
    $ppt = file_get_contents($url);
    file_put_contents ("tempf.ppt", $ppt);
    $fileHandle = fopen("tempf.ppt", "r");
    $line = @fread($fileHandle, filesize("tempf.ppt"));
    $lines = explode(chr(0x0f),$line);
    $outtext = '';

    foreach($lines as $thisline) {
        if (strpos($thisline, chr(0x00).chr(0x00).chr(0x00)) == 1) {
            $text_line = substr($thisline, 4);
            $end_pos   = strpos($text_line, chr(0x00));
            $text_line = substr($text_line, 0, $end_pos);
            $text_line = preg_replace('/[^a-zA-Z0-9\s\,\.\-\n\r\t@\/\_\(\)]/',"  ",$text_line);
            $outtext = substr($text_line, 0, $end_pos)."\n".$outtext;
        }
    }
    //echo $outtext;
    file_put_contents($file_name,$outtext);
    }

//========PPTX==========
public function extractPptxText($url,$file_name){
    $xls = get_url($url);
    file_put_contents ("tempf.txt", $xls);
    $zip_handle = new ZipArchive;
    $output_text = ' ';
    if(true === $zip_handle->open("tempf.txt")){
        $slide_number = 1; //loop through slide files
        while(($xml_index = $zip_handle->locateName("ppt/slides/slide".$slide_number.".xml")) !== false){
            $xml_datas = $zip_handle->getFromIndex($xml_index); // these four lines of codes
                                                                // below were
            $xml_handle = new DOMDocument ();                   // added by me in order
            $xml_handle->preserveWhiteSpace = true;             // to preserve space between
            $xml_handle->formatOutput = true;                   // each read data
            $xml_handle->loadXML($xml_datas, LIBXML_NOENT | LIBXML_XINCLUDE | LIBXML_NOERROR | LIBXML_NOWARNING);
            $output_text .= $xml_handle->saveXML();
            $slide_number++;
            }
        if($slide_number == 1){
            $output_text .= "";
        }
        $zip_handle->close();
    }else{
    $output_text .= "";
    }
    echo $output_text;
    file_put_contents($file_name,$output_text);
    }

   
} 
?>