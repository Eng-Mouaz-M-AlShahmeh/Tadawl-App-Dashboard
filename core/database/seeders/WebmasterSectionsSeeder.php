<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\WebmasterSection;

class WebmasterSectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Site pages
        $sections = new WebmasterSection();
        $sections->row_no = 1;
        $sections->title_ar = "صفحات الموقع";
        $sections->title_en = "Site pages";
        $sections->seo_title_ar = "صفحات الموقع";
        $sections->seo_title_en = "Site pages";
        $sections->seo_url_slug_ar = "sitepages";
        $sections->seo_url_slug_en = "sitepages";
        $sections->type = 0;
        $sections->sections_status = 0;
        $sections->comments_status = 0;
        $sections->date_status = 0;
        $sections->longtext_status = 1;
        $sections->editor_status = 1;
        $sections->attach_file_status = 1;
        $sections->multi_images_status = 1;
        $sections->section_icon_status = 1;
        $sections->icon_status = 0;
        $sections->maps_status = 1;
        $sections->order_status = 0;
        $sections->related_status = 0;
        $sections->expire_date_status = 0;
        $sections->extra_attach_file_status = 0;
        $sections->status = 1;
        $sections->created_by = 1;
        $sections->save();

        // Services
        $sections = new WebmasterSection();
        $sections->row_no = 2;
        $sections->title_ar = "الخدمات";
        $sections->title_en = "Services";
        $sections->seo_title_ar = "الخدمات";
        $sections->seo_title_en = "Services";
        $sections->seo_url_slug_ar = "services";
        $sections->seo_url_slug_en = "services";
        $sections->type = 0;
        $sections->sections_status = 0;
        $sections->comments_status = 0;
        $sections->date_status = 0;
        $sections->longtext_status = 1;
        $sections->editor_status = 1;
        $sections->attach_file_status = 1;
        $sections->multi_images_status = 1;
        $sections->section_icon_status = 1;
        $sections->icon_status = 0;
        $sections->maps_status = 0;
        $sections->order_status = 1;
        $sections->related_status = 1;
        $sections->expire_date_status = 0;
        $sections->extra_attach_file_status = 0;
        $sections->status = 1;
        $sections->created_by = 1;
        $sections->save();

        // News
        $sections = new WebmasterSection();
        $sections->row_no = 3;
        $sections->title_ar = "الأخبار";
        $sections->title_en = "News";
        $sections->seo_title_ar = "الأخبار";
        $sections->seo_title_en = "News";
        $sections->seo_url_slug_ar = "news";
        $sections->seo_url_slug_en = "news";
        $sections->type = 0;
        $sections->sections_status = 0;
        $sections->comments_status = 1;
        $sections->date_status = 1;
        $sections->longtext_status = 1;
        $sections->editor_status = 1;
        $sections->attach_file_status = 0;
        $sections->multi_images_status = 1;
        $sections->section_icon_status = 1;
        $sections->icon_status = 0;
        $sections->maps_status = 0;
        $sections->order_status = 0;
        $sections->related_status = 1;
        $sections->expire_date_status = 0;
        $sections->extra_attach_file_status = 0;
        $sections->status = 1;
        $sections->created_by = 1;
        $sections->save();

        // Photos
        $sections = new WebmasterSection();
        $sections->row_no = 4;
        $sections->title_ar = "الصور";
        $sections->title_en = "Photos";
        $sections->seo_title_ar = "الصور";
        $sections->seo_title_en = "Photos";
        $sections->seo_url_slug_ar = "photos";
        $sections->seo_url_slug_en = "photos";
        $sections->type = 1;
        $sections->sections_status = 0;
        $sections->comments_status = 1;
        $sections->date_status = 0;
        $sections->longtext_status = 0;
        $sections->editor_status = 0;
        $sections->attach_file_status = 0;
        $sections->multi_images_status = 1;
        $sections->section_icon_status = 1;
        $sections->icon_status = 0;
        $sections->maps_status = 0;
        $sections->order_status = 0;
        $sections->related_status = 0;
        $sections->expire_date_status = 0;
        $sections->extra_attach_file_status = 0;
        $sections->status = 1;
        $sections->created_by = 1;
        $sections->save();

        // Videos
        $sections = new WebmasterSection();
        $sections->row_no = 5;
        $sections->title_ar = "الفيديو";
        $sections->title_en = "Videos";
        $sections->seo_title_ar = "الفيديو";
        $sections->seo_title_en = "Videos";
        $sections->seo_url_slug_ar = "videos";
        $sections->seo_url_slug_en = "videos";
        $sections->type = 2;
        $sections->sections_status = 1;
        $sections->comments_status = 1;
        $sections->date_status = 0;
        $sections->longtext_status = 0;
        $sections->editor_status = 0;
        $sections->attach_file_status = 0;
        $sections->multi_images_status = 0;
        $sections->section_icon_status = 1;
        $sections->icon_status = 0;
        $sections->maps_status = 0;
        $sections->order_status = 0;
        $sections->related_status = 1;
        $sections->expire_date_status = 0;
        $sections->extra_attach_file_status = 0;
        $sections->status = 1;
        $sections->created_by = 1;
        $sections->save();

        // Sounds
        $sections = new WebmasterSection();
        $sections->row_no = 6;
        $sections->title_ar = "الصوتيات";
        $sections->title_en = "Audio";
        $sections->seo_title_ar = "الصوتيات";
        $sections->seo_title_en = "Audio";
        $sections->seo_url_slug_ar = "audio";
        $sections->seo_url_slug_en = "audio";
        $sections->type = 3;
        $sections->sections_status = 1;
        $sections->comments_status = 1;
        $sections->date_status = 0;
        $sections->longtext_status = 0;
        $sections->editor_status = 0;
        $sections->attach_file_status = 0;
        $sections->multi_images_status = 0;
        $sections->section_icon_status = 1;
        $sections->icon_status = 0;
        $sections->maps_status = 0;
        $sections->order_status = 0;
        $sections->related_status = 1;
        $sections->expire_date_status = 0;
        $sections->extra_attach_file_status = 0;
        $sections->status = 1;
        $sections->created_by = 1;
        $sections->save();

        // Articles
        $sections = new WebmasterSection();
        $sections->row_no = 7;
        $sections->title_ar = "المدونة";
        $sections->title_en = "Blog";
        $sections->seo_title_ar = "المدونة";
        $sections->seo_title_en = "Blog";
        $sections->seo_url_slug_ar = "blog";
        $sections->seo_url_slug_en = "blog";
        $sections->type = 0;
        $sections->sections_status = 1;
        $sections->comments_status = 1;
        $sections->date_status = 1;
        $sections->longtext_status = 1;
        $sections->editor_status = 1;
        $sections->attach_file_status = 0;
        $sections->multi_images_status = 1;
        $sections->section_icon_status = 1;
        $sections->icon_status = 0;
        $sections->maps_status = 0;
        $sections->order_status = 0;
        $sections->related_status = 1;
        $sections->expire_date_status = 0;
        $sections->extra_attach_file_status = 0;
        $sections->status = 1;
        $sections->created_by = 1;
        $sections->save();

        // Products
        $sections = new WebmasterSection();
        $sections->row_no = 8;
        $sections->title_ar = "المنتجات";
        $sections->title_en = "Products";
        $sections->seo_title_ar = "المنتجات";
        $sections->seo_title_en = "Products";
        $sections->seo_url_slug_ar = "products";
        $sections->seo_url_slug_en = "products";
        $sections->type = 0;
        $sections->sections_status = 2;
        $sections->comments_status = 1;
        $sections->date_status = 0;
        $sections->longtext_status = 1;
        $sections->editor_status = 1;
        $sections->attach_file_status = 0;
        $sections->multi_images_status = 1;
        $sections->section_icon_status = 1;
        $sections->icon_status = 0;
        $sections->maps_status = 0;
        $sections->order_status = 1;
        $sections->related_status = 1;
        $sections->expire_date_status = 0;
        $sections->extra_attach_file_status = 0;
        $sections->status = 1;
        $sections->created_by = 1;
        $sections->save();

        // Partners
        $sections = new WebmasterSection();
        $sections->row_no = 9;
        $sections->title_ar = "العملاء";
        $sections->title_en = "Partners";
        $sections->seo_title_ar = "العملاء";
        $sections->seo_title_en = "Partners";
        $sections->seo_url_slug_ar = "partners";
        $sections->seo_url_slug_en = "partners";
        $sections->type = 0;
        $sections->sections_status = 0;
        $sections->comments_status = 0;
        $sections->date_status = 0;
        $sections->longtext_status = 0;
        $sections->editor_status = 0;
        $sections->attach_file_status = 0;
        $sections->multi_images_status = 0;
        $sections->section_icon_status = 0;
        $sections->icon_status = 0;
        $sections->maps_status = 0;
        $sections->order_status = 0;
        $sections->related_status = 0;
        $sections->expire_date_status = 0;
        $sections->extra_attach_file_status = 0;
        $sections->status = 1;
        $sections->created_by = 1;
        $sections->save();


    }
}
