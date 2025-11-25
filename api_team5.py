# api_team5.py
from fastapi import FastAPI
import uvicorn
import threading
from team import FF_CLIENT, map_team_number

app = FastAPI()

@app.get("/team5")
def run_team5(uid: int):

    # team5 tương ứng team_number = 4 theo map_team_number
    team_number = map_team_number(5)

    def worker():
        try:
            client = FF_CLIENT(
                id="4269662171",
                password="EF7B7407EC354BD7D2FD8939EA0C064A50CD899E9282EEC998E972BAFF4DAEB3",
                target_uid=uid,
                team_number=team_number
            )
            client.start()
            client.join()
        except Exception as e:
            print("Error:", e)

    threading.Thread(target=worker).start()

    return {
        "status": "OK",
        "uid": uid,
        "team": 5,
        "msg": "Đã gửi lời mời TEAM5 chạy thật"
    }


if __name__ == "__main__":
    uvicorn.run(app, host="0.0.0.0", port=8080)
