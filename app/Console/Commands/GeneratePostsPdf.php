<?php

namespace App\Console\Commands;

use GrahamCampbell\ResultType\Success;
use Illuminate\Console\Command;
use App\Models\Post;
use Pdf;

class GeneratePostsPdf extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'genrate:pdf';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //return "Success";
        $posts = Post::with('author')->withCount('comments')->get();
        //dd($posts[0]->author);

        $pdf =PDF::loadView('pdf.posts', compact('posts'));

        $pdf->save(public_path('posts.pdf'));

        $this->info('PDF generated successfully!');
        //$this->info("pdf download sucessfully");

    }
}
