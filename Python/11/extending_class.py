class Car():
    def __init__(self, *args, **kargs):
        self.wheels = 4
        self.color = kargs.get("color", "black")
        self.windows = 4
        self.seats = 4
        self.price = kargs.get("price", "$20")

    def __str__(self):
        return f"Car with {self.wheels} wheels"


class Convertible(Car):
    def __init__(self, **kargs):
        super().__init__(**kargs)
        self.time = kargs.get("time", 10)

    def take_off(self):
        return "taking off"

    def __str__(self):
        return f"Car with no roof"


porche = Convertible(color="green", price="$30")

print(porche.take_off())
print(porche.color)
