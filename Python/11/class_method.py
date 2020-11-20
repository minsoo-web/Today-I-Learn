class Car():
    def __init__(self, *args, **kargs):
        self.wheels = 4
        self.color = kargs.get("color", "black")
        self.windows = 4
        self.seats = 4
        self.price = kargs.get("price", "$20")

    def __str__(self):
        return f"Car with {self.wheels} wheels"

    def start(self):
        print("I started")


porche = Car(color="green", price="$40")
print(porche.color, porche.price)

mini = Car()
print(mini.color, mini.price)
