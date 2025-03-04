export interface MediaFile {
    id: string;
    name: string;
    file_name: string;
    original_file_name: string;
    url: string;
    primary: boolean;
    moderation_required: boolean;
    type: string; // "IMAGE" or "VIDEO"
    duration: number;
    height: number;
    width: number;
    thumbnails: Thumbnail[];
  }
  
  export interface Thumbnail {
    height: number;
    width: number;
    url: string;
  }
  
  export interface Portfolio {
    IMAGES: MediaFile[];
    VIDEOS: MediaFile[];
  }
  
  export interface Followers {
    instagram: string;
    youtube: string;
    twitter: string;
  }
  
  export interface UserProfile {
    name: string;
    profession: string;
    country: string;
    state: string;
    city: string;
    biography: string;
    profile_image: string;
    cover_image: string;
    portfolio: Portfolio;
    followers: Followers;
  }
  