public static function getFile($fileName) {
            $params = array();
            $params['filename'] = $fileName;
            $file_array = self::APICall("/KnowledgeBase/get.php", $params);
            $file = new File(
                    $file_array->{'courseID'}),
                    $file_array->{'userID'},
                    $file_array->{'content'},
                    $file_array->{'approved'}
                );
            }
            return $file;
        }