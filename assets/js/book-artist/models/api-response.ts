export interface Portfolio {
    IMAGES: any[]; // Replace `any` with a specific type if you know the structure of images.
    VIDEOS: any[]; // Replace `any` with a specific type if you know the structure of videos.
}

export interface Artist {
    id: number;
    name: string;
    profession: string;
    country: string;
    state: string;
    city: string;
    biography: string;
    profile_image: string;
    cover_image: string;
    followers: Followers; 
    portfolio: Portfolio;
}

export interface Pagination {
    page: number;
    pageSize: number;
    totalPages: number;
    totalPosts: number;
}

export interface Followers {
    instagram: AccountInfo;
    youtube: AccountInfo;
    twitter: AccountInfo;
}

export interface AccountInfo {
    img: string;
    name: string;
    url: string;
    followers: string;
}


export interface Data {
    posts: Artist[];
    pagination: Pagination;
}

export interface ApiResponse {
    status: boolean;
    statusCode: number;
    data: Data;
    message: string;
}

export interface ProfileApiResponse {
    status: boolean;
    statusCode: number;
    data: Artist;
    message: string;
}
