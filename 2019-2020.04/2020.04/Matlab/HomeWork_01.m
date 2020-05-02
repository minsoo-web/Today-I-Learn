expectValue = randi(10,100,1);
realValue = randi(10,100,1);

confusion = myfunc(expectValue,realValue);

function output = myfunc(expect,real)
  c = zeros(10,10);
  for i=1:size(expect)
    ex = expect(i,1);
    re = real(i,1);
    c(ex,re) = c(ex,re) + 1;
  end 
  output = c; 
end 

% 임의의 두 벡터 100 x 1 가 얼마나 유사한지를 10x10 매트릭스에 결과 도출하는 함수 
