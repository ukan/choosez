<?php

namespace App\Providers;

use Blade;
use Sentinel;
use DB;
use App\Models\Menu;
use App\Models\User;
use App\Models\BulletinBoard;
use Illuminate\Support\ServiceProvider;
use Illuminate\Config\Repository as IlluminateConfig;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(IlluminateConfig $config)
    {   
        view()->composer('*', function ($view) use ($config) {
            $pathp = "";

            (($config->get('app.env') == "local") ? $pathp="" : $pathp="public/" );
            
            $view->withPathp($pathp);
        });
        $this->bootBladeCustomDirectives();
        $this->bootMenuViewComposer();
        $this->bootNewsViewComposer();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function bootBladeCustomDirectives()
    {
        Blade::directive('hasaccess', function ($expression) {
            if (Sentinel::check()) {
                return "<?php if (General::hasAccess{$expression}): ?>";
            }

            return;
        });

        Blade::directive('endhasaccess', function ($expression) {
            if (Sentinel::check()) {
                return "<?php endif; ?>";
            }

            return;
        });
    }

    /**
     * Bootstrap our menus.
     *
     * @return void
     */
    private function bootMenuViewComposer()
    {
        view()->composer('layout.backend.admin.master.master', function ($view) {
            $index = 0;
            $menus = Menu::where('parent', null)->orderBy('id', 'ASC')->get()->toArray();
            
            foreach ($menus as $menu) {
                if ((bool) $menu['is_parent']) {
                    if ($child = Menu::where('parent', $menu['id'])->get()->toArray()) {
                        foreach ($child as $value) {
                            $menus[$index]['child'][] = $value;
                            $menus[$index]['child_permissions'][] = $value['name'];
                        }
                    }
                }

                $index++;
            }
            $view->withMenus($menus);
        });
    }

    /**
     * Bootstrap our news right bar.
     *
     * @return void
     */
    private function bootNewsViewComposer()
    {
        view()->composer('frontend.right_bar', function ($view) {
            $data = BulletinBoard::where('publish_status', 'Yes')
                    ->orderBy('counter', 'desc')
                    ->take(5)->get();

            $getData = [];
            $x = 0;

            foreach ($data as $key => $value) {
                $getData[$x] = $value;
                
                $x++;
            }

            $dataRecent = BulletinBoard::where('publish_status', 'Yes')
                    ->orderBy('publish_date', 'desc')
                    ->take(5)->get();

            $getDataRecent = [];
            $x = 0;

            foreach ($dataRecent as $key => $value) {
                $getDataRecent[$x] = $value;
                
                $x++;
            }

            $view->with('bulletin_populer',$getData)->with('bulletin_recent',$getDataRecent);
        });
    }

    /**
     * Bootstrap our public path.
     *
     * @return void
     */
    private function bootPublicPathComposer()
    {
        
    }

    public function datediff($tgl1, $tgl2)
    {
        $tgl1 = strtotime($tgl1);
        $tgl2 = strtotime($tgl2);
        $diff_secs = abs($tgl1 - $tgl2);
        $base_year = min(date("Y", $tgl1), date("Y", $tgl2));
        $diff = mktime(0, 0, $diff_secs, 1, 1, $base_year);

        return array( "years" => date("Y", $diff) - $base_year, "months_total" => (date("Y", $diff) - $base_year) * 12 + date("n", $diff) - 1, "months" => date("n", $diff) - 1, "days_total" => floor($diff_secs / (3600 * 24)), "days" => date("j", $diff) - 1, "hours_total" => floor($diff_secs / 3600), "hours" => date("G", $diff), "minutes_total" => floor($diff_secs / 60), "minutes" => (int) date("i", $diff), "seconds_total" => $diff_secs, "seconds" => (int) date("s", $diff) );
    }
}
