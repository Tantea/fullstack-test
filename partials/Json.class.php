<?php 
class Json{ 
    private $jsonFile = "../dataset/users.json"; 
     
 
    public function getRows(){ 
        if(file_exists($this->jsonFile)){ 
            $jsonData = file_get_contents($this->jsonFile); 
            $data = json_decode($jsonData, true);  
            if(!empty($data)){ 
                usort($data, function($a, $b) { 
                    return $b['id'] - $a['id']; 
                }); 
            }  
             
            return !empty($data)?$data:false; 
        } 
        return false; 
    } 
     
    public function getSingle($id){ 
        $jsonData = file_get_contents($this->jsonFile); 
        $data = json_decode($jsonData, true); 
        $singleData = array_filter($data, function ($var) use ($id) { 
            return (!empty($var['id']) && $var['id'] == $id); 
        }); 
        $singleData = array_values($singleData)[0]; 
        return !empty($singleData)?$singleData:false; 
    } 
     
    public function insert($newData){ 
        if(!empty($newData)){ 
            $id = time(); 
            $newData['id'] = $id; 
             
            $jsonData = file_get_contents($this->jsonFile); 
            $data = json_decode($jsonData, true); 
             
            $data = !empty($data)?array_filter($data):$data; 
            if(!empty($data)){ 
                array_push($data, $newData); 
            }else{ 
                $data[] = $newData; 
            } 
            $insert = file_put_contents($this->jsonFile, json_encode($data)); 
             
            return $insert?$id:false; 
        }else{ 
            return false; 
        } 
    } 
     
    public function update($upData, $id){ 
        if(!empty($upData) && is_array($upData) && !empty($id)){ 
            $jsonData = file_get_contents($this->jsonFile); 
            $data = json_decode($jsonData, true); 
             
            foreach ($data as $key => $value) { 
                if ($value['id'] == $id) { 
                    if(isset($upData['name'])){ 
                        $data[$key]['name'] = $upData['name']; 
                    } 
                    if(isset($upData['username'])){ 
                        $data[$key]['username'] = $upData['username']; 
                    } 
                    if(isset($upData['email'])){ 
                        $data[$key]['email'] = $upData['email']; 
                    } 
                    if(isset($upData['street'])){ 
                        $data[$key]['street'] = $upData['street'];  
                    } 
                    if(isset($upData['suite'])){  
                        $data[$key]['suite'] = $upData['suite'];  
                    } 
                    if(isset($upData['city'])){  
                        $data[$key]['city'] = $upData['city'];  
                    } 
                    if(isset($upData['zipcode'])){  
                        $data[$key]['zipcode'] = $upData['zipcode']; 
                    } 
                    if(isset($upData['phone'])){ 
                        $data[$key]['phone'] = $upData['phone']; 
                    } 
                    if(isset($upData['country'])){ 
                        $data[$key]['country'] = $upData['country']; 
                    } 
                    if(isset($upData['website'])){ 
                        $data[$key]['website'] = $upData['website']; 
                    } 
                } 
            } 
            $update = file_put_contents($this->jsonFile, json_encode($data)); 
             
            return $update?true:false; 
        }else{ 
            return false; 
        } 
    } 
     
    public function delete($id){ 
        $jsonData = file_get_contents($this->jsonFile); 
        $data = json_decode($jsonData, true); 
             
        $newData = array_filter($data, function ($var) use ($id) { 
            return ($var['id'] != $id); 
        }); 
        $delete = file_put_contents($this->jsonFile, json_encode($newData)); 
        return $delete?true:false; 
    } 
}