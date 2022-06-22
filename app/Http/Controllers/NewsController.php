<?php
/**
 * @author REDHEAD-DEV => Kravchenko Dmitriy
 */
namespace App\Http\Controllers;

use App\Http\Requests\News\StoreNewsRequest;
use App\Http\Requests\News\UpdateNewsRequest;
use App\Http\Traits\ResponseBody;
use App\Http\Traits\SaveImage;
use App\Models\News;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Список всех Новостей
     *
     * @return JsonResponse
     */
    public function index()
    {
        return response()->json(ResponseBody::getBody(News::all()));
    }

    /**
     * Создание новой Новости
     *
     * @param StoreNewsRequest $request
     * @return JsonResponse
     */
    public function store(StoreNewsRequest $request): JsonResponse
    {
        $request['image'] = SaveImage::upload($request['image']);

        $news = News::create($request->all());

        return response()->json(ResponseBody::getBody(['id' => $news->id]));

    }

    /**
     * Получение конкретной новости
     *
     * @param News $news
     * @return JsonResponse
     */
    public function show(News $news): JsonResponse
    {
        return response()->json(ResponseBody::getBody($news));
    }


    /**
     * Обновление Новости
     *
     * @param UpdateNewsRequest $request
     * @param News $news
     * @return JsonResponse
     */
    public function update(Request $request, News $news): JsonResponse
    {

        if ($request['image']) {
            $request['image'] = SaveImage::upload($request['image']);
        }

        $data = News::find($news->id);
        $data->update($request->all());

        return response()->json(ResponseBody::getBody(['id' => $news->id]));
    }


    /**
     * Удаление новости
     *
     * @param News $news
     * @return \Illuminate\Http\Response
     */
    public function destroy(News $news)
    {
        News::find($news->id)->delete();

        return response()->json(ResponseBody::getBody(['id' => $news->id]));

    }
}
