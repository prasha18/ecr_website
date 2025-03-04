<?php

include("../includes/connect.php");

header('Access-Control-Allow-Origin: *');  
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$pageSize = isset($_GET['pageSize']) ? (int)$_GET['pageSize'] : 10;
$ids = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($ids <= 0) {
    echo json_encode([
        "status" => false,
        "statusCode" => 400,
        "message" => "Invalid artist ID."
    ]);
    exit;
}

$start = ($page - 1) * $pageSize;

$sql = "
    SELECT 
        book_artist.id,
        book_artist.name,
        book_artist.profession,
        book_artist.country,
        book_artist.state,
        book_artist.city,
        book_artist.profile,
        book_artist.banner,
        book_artist.about,
 book_artist_img.img_id, book_artist_img.description AS imgtxt, book_artist_img.file_name as imgname,book_artist_img.moderation_required as imgmod,book_artist_img.original_file_name as imgorg,book_artist_img.imgurl  as imgurl,        book_artist_video.*,
        book_artist.inscnt, book_artist.insimg, book_artist.insname, book_artist.insurl,
        book_artist.facecnt, book_artist.faceimg, book_artist.facename, book_artist.faceurl,
        book_artist.youcnt, book_artist.youimg, book_artist.youname, book_artist.youurl
    FROM 
        book_artist
    LEFT JOIN 
        book_artist_img 
    ON 
        book_artist_img.bookid = book_artist.id 
    LEFT JOIN 
        book_artist_video 
    ON 
        book_artist_video.bookid = book_artist.id 
    WHERE 
        book_artist.status = 'Active' AND book_artist.id = $ids
    ORDER BY 
        book_artist.id DESC";
$result = $connect->query($sql);


// $stmt = $connect->prepare($sql);
// $stmt->bind_param("iii", $ids, $start, $pageSize);
// $stmt->execute();
// $result = $stmt->get_result();

$response = array();

if ($result->num_rows > 0) {
    $artistData = null;

    while ($row = $result->fetch_assoc()) {
        if ($artistData === null) {
            $artistData = [
                'id' => $row['id'],
                'name' => $row['name'],
                'profession' => $row['profession'],
                'country' => $row['country'],
                'state' => $row['state'],
                'city' => $row['city'],
                'profile_image' => $row['profile'],
                'cover_image' => $row['banner'],
                'biography' => $row['about'],
                'followers' => [],
                'portfolio' => [
                    'IMAGES' => [],
                    'VIDEOS' => []
                ]
            ];
        }

        // Add social media details to followers
        if (!empty($row['inscnt'])) {
            $artistData['followers']['instagram'] = [
                'img' => $row['insimg'],
                'name' => $row['insname'],
                'url' => $row['insurl'],
                'followers' => $row['inscnt']
            ];
        }

        if (!empty($row['facecnt'])) {
            $artistData['followers']['twitter'] = [
                'img' => $row['faceimg'],
                'name' => $row['facename'],
                'url' => $row['faceurl'],
                'followers' => $row['facecnt']
            ];
        }

        if (!empty($row['youcnt'])) {
            $artistData['followers']['youtube'] = [
                'img' => $row['youimg'],
                'name' => $row['youname'],
                'url' => $row['youurl'],
                'followers' => $row['youcnt']
            ];
        }

        // Deduplicate IMAGES by img_id
        if (!empty($row['img_id'])) {
            $imageExists = false;

            foreach ($artistData['portfolio']['IMAGES'] as $existingImage) {
                if ($existingImage['id'] == $row['img_id']) {
                    $imageExists = true;
                    break;
                }
            }

            if (!$imageExists) {
                $artistData['portfolio']['IMAGES'][] = [
                    'id' => $row['img_id'],
                    'name' => $row['imgtxt'],
                    'file_name' => $row['imgname'],
                    'original_file_name' => $row['imgorg'],
                    'url' => $row['imgurl'],
                    'moderation_required' => $row['imgmod'],
                    'type' => 'IMAGE',
                    'duration' => 0.0,
                    'height' => 0,
                    'width' => 0,
                    'thumbnails' => []
                ];
            }
        }

        // Deduplicate VIDEOS by video_id
        if (!empty($row['vid'])) {
            $videoExists = false;

            foreach ($artistData['portfolio']['VIDEOS'] as $existingVideo) {
                if ($existingVideo['id'] == $row['vid']) {
                    $videoExists = true;
                    break;
                }
            }

            if (!$videoExists) {
                $artistData['portfolio']['VIDEOS'][] = [
                    'id' => $row['vid'],
                    'name' => $row['description'],
                    'file_name' => $row['file_name'],
                    'original_file_name' => $row['original_file_name'],
                    'url' => $row['videourl'],
                    'moderation_required' => $row['moderation_required'],
                    'type' => 'VIDEO',
                    'duration' => 0.0,
                    'height' => 0,
                    'width' => 0,
                    'thumbnails' => $row['vid_thumbnail']
                ];
            }
        }
    }

    $response['status'] = true;
    $response['statusCode'] = 200;
    $response['message'] = "Data fetched successfully.";
    $response['data'] = $artistData;
} else {
    $response['status'] = false;
    $response['statusCode'] = 404;
    $response['data'] = null;
    $response['message'] = "No data found.";
}

header('Content-Type: application/json');
echo json_encode($response, JSON_PRETTY_PRINT);

$connect->close();

?>
