def plus(*args, **kargs):
    answer = 0
    for number in args:
        if kargs['operator'] == 'plus':
            answer += number
        else:
            answer = "None"
    return answer


result = plus(1, 2, 3, 4, 5, operator='div')
print(result)
