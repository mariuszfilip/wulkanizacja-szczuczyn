<?php
/**
 * Generowanie miniaturek razem z cache'owaniem
 */

class Thumb {
  protected $x							= 0;
  protected $dir            = '';
  protected $file           = '';
  protected $w              = 0;
  protected $h              = 0;
  protected $thumbs_dir     = 'var/thumbs/';
  protected $file_name      = '';
  protected $file_extension = '';
  protected $size_w         = 0;
  protected $size_h         = 0;
  protected $mime           = '';
  protected $mime_arr       = array(
			'gif'=>'Content-type: image/gif',
			'jpg'=>'Content-type: image/jpg',
			'png'=>'Content-type: image/png'
	);
  /**
   * @param string $dir
   * @param string $file
   * @param integer $w
   * @param integer $h
   */
  public function __construct($dir, $file, $w = 0, $h = 0) {
  	$this->dir			= trim($dir);
  	$this->file			= trim($file);
  	$this->w				= (int)$w;
  	$this->h				= (int)$h;		
		$this->dec_w		= (int)$w;
  	$this->dec_h		= (int)$h;		
  	$this->setPicture();
  	$this->setImageSize();

  }

  public function setMime( $extension ) {
    if( isset( $this->mime_arr[$extension] ) ) {
      $this->mime = $this->mime_arr[$extension];
      return true;
    } else {
      return false;
    }
  }

  public function getFileExtension() {
    return $this->file_extension;
  }

  public function getMime() {
    return $this->mime;
  }

  public function setThumbsDir( $thumbs_dir ) {
    $this->thumbs_dir = $thumbs_dir;
  }

  protected function setPicture() {
    $picture              = explode( '.', $this->file );
    $this->file_name      = $picture[0];
    $this->file_extension = strtolower($picture[1]);
  }

  protected function setImageSize() {
    if ( !empty( $this->dir ) ) {
      $size = getimagesize( $this->dir . '/' . $this->file );
    } else {
      $size = getimagesize( $this->file );
    }
    $this->size_w = (int)$size[0];
    $this->size_h = (int)$size[1];

    if( $this->h > 0 && $this->w > 0 ) {
      if( $this->size_h > $this->size_w ) {
        $this->h = $this->h;
        $this->w = $this->size_w * ( $this->h / $this->size_h );
      } elseif ( $this->size_h < $this->size_w ) {
        $this->h = $this->size_h * ( $this->w / $this->size_w );
        $this->w = $this->w;
      } elseif ( $this->size_h == $this->size_w ) {
        $this->h = $this->size_h * ( $this->w / $this->size_w );
        $this->w = $this->w;
      }
    } elseif ( $this->w==0 && $this->h>0 ) {
      $this->h = $this->h;
      $this->w = $this->size_w * ( $this->h / $this->size_h );
    } elseif ( $this->h==0 && $this->w>0 ) {
      $this->h = $this->size_h * ( $this->w / $this->size_w );
      $this->w = $this->w;
    }
		
		if($this->w > $this->dec_w && $this->dec_w > 0) {
			$this->w = $this->dec_w;
			$this->h = $this->size_h * ( $this->w / $this->size_w );
		}
		if($this->h > $this->dec_h && $this->dec_h > 0) {
			$this->h = $this->dec_h;
			$this->w = $this->size_w * ( $this->h / $this->size_h );
		}
		
		$this->h = round($this->h);
		$this->w = round($this->w);
		
  }

  public function screenPicture() {
    if ( file_exists( $this->thumbs_dir . $this->file_name . '_' . $this->w . 'x' . $this->h . '.' . $this->file_extension ) ) {
      // Jesli plik istnieje na dysku to czytamy z dysku
      $file = file_get_contents( $this->thumbs_dir . $this->file_name . '_' . $this->w . 'x' . $this->h . '.' . $this->file_extension );
      echo $file;
    } else {
      // Jesli nie istnieje to zapisujemy na dysku
      $newfilename = $this->thumbs_dir . $this->file_name . '_' . $this->w . 'x' . $this->h . '.' . $this->file_extension ;
      switch ( $this->file_extension ) {
        case 'gif' :
          $src_im = imagecreatefromgif( $this->dir . '/' . $this->file );
          $dst_im = imagecreatetruecolor( $this->w, $this->h );
					$trnprt_indx = imagecolortransparent($src_im);					
					if ($trnprt_indx >= 0) {
						// Get the original image's transparent color's RGB values
						$trnprt_color = imagecolorsforindex($src_im, $trnprt_indx);
						// Allocate the same color in the new image resource
						$trnprt_indx = imagecolorallocate($dst_im, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
						// Completely fill the background of the new image with allocated color.
						imagefill($dst_im, 0, 0, $trnprt_indx);   
						// Set the background color for new image to transparent
						imagecolortransparent($dst_im, $trnprt_indx);
					}
          imagecopyresampled( $dst_im, $src_im, 0, 0, 0, 0, $this->w, $this->h, $this->size_w, $this->size_h );
          imagegif( $dst_im, $newfilename, 9 );
          imagegif( $dst_im, '', 9 );
          imagedestroy( $dst_im );
          break;
        case 'jpg' :
          $src_im = imagecreatefromjpeg( $this->dir . '/' . $this->file ) ;
          $dst_im = imagecreatetruecolor( $this->w, $this->h ) ;
          imagecopyresampled( $dst_im, $src_im, 0, 0, 0, 0, $this->w, $this->h, $this->size_w, $this->size_h );
          imagejpeg( $dst_im, $newfilename, 100 ) ;
          imagejpeg( $dst_im, '', 100 ) ;
          imagedestroy( $dst_im ) ;
          break;
        case 'png' :
					$src_im = imagecreatefrompng( $this->dir . '/' . $this->file );
          $dst_im = imagecreatetruecolor( $this->w, $this->h ) ;				
					imagealphablending( $dst_im, false );
					imagesavealpha( $dst_im, true );
					imagecopyresampled( $dst_im, $src_im, 0, 0, 0, 0, $this->w, $this->h, $this->size_w, $this->size_h );			
					imagepng($dst_im, $newfilename, 9 );
					imagepng($dst_im, '', 9 );
					imagedestroy( $dst_im ) ;
					break;
      }
    }
  }

}
?>