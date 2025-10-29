<?php

namespace Database\Seeders;

use App\Repositories\OrganizationRepository;
use App\Repositories\SocialMediaRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExistsOrgSocialLinksAddSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizations =  OrganizationRepository::query()->get();

        foreach ($organizations as $organization) {
            $socialMedia = [
                ['title' => 'Facebook', 'icon' => 'bi bi-facebook'],
                ['title' => 'Twitter', 'icon' => 'bi bi-twitter'],
                ['title' => 'Whatsapp', 'icon' => 'bi bi-whatsapp'],
                ['title' => 'Linkedin', 'icon' => 'bi bi-linkedin'],
                ['title' => 'Instagram', 'icon' => 'bi bi-instagram'],
                ['title' => 'Youtube', 'icon' => 'bi bi-youtube'],
                ['title' => 'Pinterest', 'icon' => 'bi bi-pinterest'],
                ['title' => 'Tiktok', 'icon' => 'bi bi-tiktok'],
                ['title' => 'Snapchat', 'icon' => 'bi bi-snapchat'],
                ['title' => 'Reddit', 'icon' => 'bi bi-reddit'],
                ['title' => 'Vimeo', 'icon' => 'bi bi-vimeo'],
                ['title' => 'Twitch', 'icon' => 'bi bi-twitch'],
            ];

            foreach ($socialMedia as $media) {
                SocialMediaRepository::query()->updateOrCreate(
                    [
                        'organization_id' => $organization->id,
                        'title' => $media['title'], // check uniqueness by org + title
                    ],
                    [
                        'icon' => $media['icon'],
                        'url' => null,
                    ]
                );
            }
        }
    }
}
