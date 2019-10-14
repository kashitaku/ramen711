<?php
namespace app\Http\Controllers;
use Illuminate\Http\Request;
use app\Shop;

class AdminController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
	public function admin() {
		return $this->belongsTo('app\Admin');
	}

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
	public function index(Request $request) {
		$keyword = $request->input('keyword');
		$keyword_station = $request->input('keyword_station');
		$sort = $request->sort;
		$query = Shop::query();
		if($keyword || $keyword_station || $sort) {
			if ($keyword) {
				$query->where('name', 'like', '%'.$keyword.'%')->get();
			}
			if ($keyword_station) {
				$query->where('name', 'like', '%'.$keyword_station.'%')->get();
			}
			
			if ($sort == 'likeDesc') {
				$query->orderBy('likes_count', 'desc')->get();
			}
		}
		$shops = $query->paginate(8)
			->appends($request->only(['keyword', 'keyword_station', 'sort']));
		return view('admin.index')
			->with('keyword', $keyword)
			->with('keyword_station', $keyword_station)
			->with('sort', $sort)
			->with('shops', $shops);
    }
	public function add(Request $request) {
		return view('admin.add');
	}
	public function create(Request $request) {
		$this->validate($request, Shop::$rules);
		$shop=new Shop;
		if($request->has('image_url')){
			$form=$request->except('admin_id', 'image_url');
			$shop->admin_id = $request->user()->id;
			$shop->image_url = $request->image_url->storeAs('public/shop_images', rand());
			$shop->admin_id = $request->user()->id;
			$shop->fill($form)->save();
		} else {
			$form=$request->except('admin_id');
			$shop->admin_id = $request->user()->id;
			$shop->fill($form)->save();
		}
		return redirect()->route('admin.index');
	}
	public function detail(Request $request) {
		$shop = Shop::find($request->id);
		if($shop->image_url) {
			$shop->image_url = str_replace('public/', 'storage/', $shop->image_url);
		}
		return view('admin.detail', ['shop'=>$shop]);
	}
	public function edit(Request $request) {
		$shop = Shop::find($request->id);
		if($shop->image_url) {
			$shop->image_url = str_replace('public/', 'storage/', $shop->image_url);
		}
		return view('admin.edit', ['shop'=>$shop]);
	}
	public function update(Request $request, $id) {
		$this->validate($request, Shop::$rules);
		$shop=Shop::find($request->id);
		if ($request->user()->id == $shop->admin_id) {
			if($request->has('image_url')){
				$shop->id = $request->id;
				$shop->name = $request->name;
				$shop->station1 = $request->station1;
				$shop->point = $request->point;
				$shop->type1 = $request->type1;
				$shop->URL = $request->URL;
				$shop->image_url = $request->image_url->storeAs('public/shop_images', rand());
				$shop->save();
			} else {
				$form=$request->except('image_url');
				$shop->fill($form)->save();
			}
		}
		return redirect()->route('admin.index');
	}
	public function delete($id) {
		Shop::find($id)->delete();
		return redirect()->route('admin.index');
	}
}
