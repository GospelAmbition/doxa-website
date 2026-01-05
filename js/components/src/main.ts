import './highlighted-people-groups';
import './uupgs-list';

declare global {
    interface Window {
        uupgsData: {
            images_url: string;
        };
    }
}