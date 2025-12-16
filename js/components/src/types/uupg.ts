export interface Uupg {
    id: string;
    name: string;
    display_name: string;
    wagf_region: KeyLabel;
    wagf_block: KeyLabel;
    wagf_member: boolean;
    country: KeyLabel;
    rop1: KeyLabel;
    location_description: string;
    has_image: boolean;
    picture_url: string;
    picture_credit_html: string;
    population: number;
    religion: KeyLabel;
    adopted: boolean;
}

interface KeyLabel {
    key: string;
    label: string;
}