
export interface Artist {
    id: number;
    name: string;
    profession: string;
    followers: Followers;
    user_verified: boolean;
    membership: 'PREMIUM_PRO' | 'PREMIUM';
    profile_image: string;
}

export interface Followers {
    instagram: number;
    twitter: number;
    youtube: number;
}

export interface Profession {
    id: string;
    profession: string;
    visible: boolean,
    members: Artist[];
}

export interface ProfessionData {
    id: string;
    name: string;
    visible: boolean;
}
